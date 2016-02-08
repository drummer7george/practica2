<?php
putEnv("ORACLE_HOME=/u01/app/oracle/product/11.2.0/xe");
putEnv("ORACLE_SID=XE");
putEnv("LD_LIBRARY_PATH=/u01/app/oracle/product/11.2.0/xe/lib"); 
//include 'ejemplo.php';

$cone = oci_connect('practica2', 'jorge', 'localhost/xe');
if (!$cone) {
    print("FUERA DE LINEA");
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    print('$e');
} else {
    print("EN LINEA");
}

// Preparar la sentencia
$stid = oci_parse($cone, 'select * from usuario');
if (!$stid) {
    $e = oci_error($cone);
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
     print("ERROR...");
}

// Realizar la lógica de la consulta
$r = oci_execute($stid);
if (!$r) {
    $e = oci_error($stid);
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

// Obtener los resultados de la consulta
print "<table border='1'>\n";
while (($fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS))!=false) {
    print "<tr>\n";
    foreach ($fila as $elemento) {
        print "    <td>" . ($elemento !== null ? htmlentities($elemento, ENT_QUOTES) : "") . "</td>\n";
    }
    print "</tr>\n";
}
print "</table>\n";

oci_free_statement($stid);
oci_close($cone)

//    echo "<a href="logout.php" title="Cerrar sesión">Bienvenid@</a>"
?>
