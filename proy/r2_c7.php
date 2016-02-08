<?php
session_start();
   putEnv("ORACLE_HOME=/u01/app/oracle/product/11.2.0/xe");
   putEnv("ORACLE_SID=XE");
   putEnv("LD_LIBRARY_PATH=/u01/app/oracle/product/11.2.0/xe/lib"); 
   include 'conexion.php' ;
   //print("estamos en rol1\n");
   
   if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
	{
	 
	}
else
{
	echo "<br/>" . "Esta pagina es solo para usuarios registrados." . "<br/>";
	echo "<br/>" . "<a href='main_login.php'>Login Here!</a>";
	 
	exit;
	
  } 


?>
<!DOCTYPE html>
<html lang="en">

<HEAD>

<TITLE>CONSULTA 7</TITLE>

</HEAD>

<BODY>

<!-- Aqui va todo lo chachi -->

<H1>CONSULTA 7</H1>
<hr/>
<?php


$consulta = "SELECT DECODE(F.NOMBRE,'Facultad De Ingenier�','INGENIERIA','Facultad De Agronom�','AGRONOMIA',
'Facultad De Ciencias M�cas','CIENCIAS MEDICAS','HUMANIDADES') FACULTAD,
COUNT( CASE WHEN R.ORDEN_OPCION = 1 THEN ID_PRUEBA END ) OP1,
COUNT( CASE WHEN R.ORDEN_OPCION = 2 THEN ID_PRUEBA END ) OP2
FROM RESULTADO_PRUEBA R, CARRERA C, FACULTAD F
WHERE R.CARRERA_ID = C.ID_CARRERA AND C.FACULTAD_UA = F.UNIDAD_ACADEMICA AND
( F.NOMBRE = 'Facultad De Ingenier�' OR F.NOMBRE = 'Facultad De Agronom�' OR
F.NOMBRE = 'Facultad De Ciencias M�cas' OR F.NOMBRE = 'Facultad De Humanidades' )
GROUP BY F.NOMBRE";

$stid = oci_parse ($conn, $consulta);

oci_execute($stid);

print '<table border="1">';
print '<tr><th>FACULTAD</th><th>PRIMERA OPCION</th><th>SEGUNDA OPCION</th></tr>';

while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    print '<tr>';
    print '<td>'.$row['FACULTAD'].'</td>';
    print '<td>'.$row['OP1'].'</td>';
    print '<td>'.$row['OP2'].'</td>';
    print '</tr>';
    // En un bucle, liberar la variable grande antes de la 2ª obtención reduce el uso de memoria de picos de PHP
    unset($row);  
}
print '</table>';

oci_free_statement($stid);
?>
<hr/>
<hr/>

<nav >
                    <ul class="sf-menu" id="nav">
                        <li ><a href="r2_consultas.php">Principal</a></li>
                        <li ><a href="logout.php">Logout</a></li>
                    </ul>
                </nav>
            </br>


</BODY>

</HTML> 
