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

<TITLE>CONSULTA 4</TITLE>

</HEAD>

<BODY>

<!-- Aqui va todo lo chachi -->

<H1>CONSULTA 4</H1>
<hr/>
<?php


$consulta = "SELECT *  FROM (SELECT ROUND(AVG(CA.NOTA),2) PROMEDIO, EST.CARNET , EST.NOMBRES,FF.NOMBRE facultad,CC.NOMBRE carrera, S.INGRESOS_FAMILIARES FROM ESTUDIANTE EST
INNER JOIN RESULTADO_PRUEBA RR
ON EST.CARNET=RR.ESTUDIANTE_CARNET
INNER JOIN CARRERA CC
ON RR.CARRERA_ID=CC.ID_CARRERA
INNER JOIN FACULTAD FF
ON FF.UNIDAD_ACADEMICA=CC.FACULTAD_UA
INNER JOIN ASIGNACION AA
ON EST.CARNET = AA.ESTUDIANTE_CARNET
INNER JOIN CONTROL_ASIGNACION CA
ON AA.CODIGO_ASIGNACION = CA.CODIGO_ASIGNACION
INNER JOIN SOLICITUD S
ON EST.CARNET = S.ESTUDIANTE_CARNET
INNER JOIN ACUERDO AC
ON S.ID_SOLICITUD = AC.SOLICITUD_APROBADA
WHERE S.INGRESOS_FAMILIARES < 2500
GROUP BY EST.CARNET, EST.NOMBRES,FF.NOMBRE,CC.NOMBRE,S.INGRESOS_FAMILIARES
ORDER BY PROMEDIO DESC) asd WHERE ROWNUM<=1";

$stid = oci_parse ($conn, $consulta);

oci_execute($stid);

print '<table border="1">';
print '<tr><th>PROMEDIO</th><th>CARNET</th><th>NOMBRES</th><th>FACULTAD</th><th>CARRERA</th><th>INGRESOS FAMILIARES</th></tr>';

while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    print '<tr>';
    print '<td>'.$row['PROMEDIO'].'</td>';
    print '<td>'.$row['CARNET'].'</td>';
    print '<td>'.$row['NOMBRES'].'</td>';
    print '<td>'.$row['FACULTAD'].'</td>';
    print '<td>'.$row['CARRERA'].'</td>';
    print '<td>'.$row['INGRESOS_FAMILIARES'].'</td>';
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
