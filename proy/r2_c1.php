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

<TITLE>CONSULTA 1</TITLE>

</HEAD>

<BODY>

<!-- Aqui va todo lo chachi -->

<H1>CONSULTA 1</H1>
<hr/>
<?php


$consulta = "select * from (
   select to_char(t.FECHA_ACUERDO,'YYYY') as YYYY, to_char(t.fecha_acuerdo,'MM-YYYY') as aa  from acuerdo t
   where to_char(t.FECHA_ACUERDO,'YYYY')='2004'
)
pivot 
(
   count(aa) 
   for aa in ('01-2004' as Enero,'02-2004' as Febrero,'03-2004' as Marzo,'04-2004' as Abril,'05-2004' as Mayo,'06-2004' as Junio,'07-2004' as Julio,'08-2004' as Agosto,'09-2004' as Septiembre,'10-2004' as Octubre,'11-2004' as Noviembre,'12-2004' as Diciembre)
)
order by YYYY";

$stid = oci_parse ($conn, $consulta);

oci_execute($stid);

print '<table border="1">';
print '<tr><th>YYYY</th><th>Enero</th><th>Febrero</th><th>Marzo</th><th>Abril</th><th>Mayo</th><th>Junio</th><th>Julio</th><th>Agosto</th><th>Septiembre</th><th>Octubre</th><th>Noviembre</th><th>Diciembre</th></tr>';

while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    print '<tr>';
    print '<td>'.$row['YYYY'].'</td>';
    print '<td>'.$row['ENERO'].'</td>';
    print '<td>'.$row['FEBRERO'].'</td>';
    print '<td>'.$row['MARZO'].'</td>';
    print '<td>'.$row['ABRIL'].'</td>';
    print '<td>'.$row['MAYO'].'</td>';
    print '<td>'.$row['JUNIO'].'</td>';
    print '<td>'.$row['JULIO'].'</td>';
    print '<td>'.$row['AGOSTO'].'</td>';
    print '<td>'.$row['SEPTIEMBRE'].'</td>';
    print '<td>'.$row['OCTUBRE'].'</td>';
    print '<td>'.$row['NOVIEMBRE'].'</td>';
    print '<td>'.$row['DICIEMBRE'].'</td>';
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
