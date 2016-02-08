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

<TITLE>CONSULTA 10</TITLE>

</HEAD>

<BODY>

<!-- Aqui va todo lo chachi -->

<H1>CONSULTA 10</H1>
<hr/>
<?php


$consulta = "select * from (
   select to_char(aa.FECHA_ACUERDO,'YYYY') anio, ee.SEXO ss from solicitud ss, acuerdo aa,estudiante ee 
where aa.SOLICITUD_APROBADA=ss.id_solicitud and to_number(to_char(aa.FECHA_ACUERDO,'YYYY'))>=2004 and to_number(to_char(aa.FECHA_ACUERDO,'YYYY'))<=2005
and ss.estudiante_carnet=ee.carnet
order by anio
)
pivot 
(
   count(ss) 
   for ss in ('M' as Masculino,'F' as Femenino)
)
order by anio";

$stid = oci_parse ($conn, $consulta);

oci_execute($stid);

print '<table border="1">';
print '<tr><th>YYYY</th><th>MASCULINO</th><th>FEMENINO</th></tr>';

while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    print '<tr>';
    print '<td>'.$row['ANIO'].'</td>';
    print '<td>'.$row['MASCULINO'].'</td>';
    print '<td>'.$row['FEMENINO'].'</td>';
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
