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

<TITLE>CONSULTA 3</TITLE>

</HEAD>

<BODY>

<!-- Aqui va todo lo chachi -->

<H1>CONSULTA 3</H1>
<hr/>
<?php


$consulta = "select * from (
   select to_char(t.FECHA_ACUERDO,'YYYY') as YYYY, ss.anio_beca  as aa  from acuerdo t,solicitud ss
   where to_number(to_char(t.FECHA_ACUERDO,'YYYY'))>=2000 and to_number(to_char(t.FECHA_ACUERDO,'YYYY'))<=2012 and ss.id_solicitud=t.solicitud_aprobada
)
pivot 
(
   count(aa) 
   for aa in ('01' as Anio1,'02' as Anio2,'03' as Anio3,'04' as Anio4,'05' as Anio5,'06' as Anio6)
)
order by YYYY";

$stid = oci_parse ($conn, $consulta);

oci_execute($stid);

print '<table border="1">';
print '<tr><th>YYYY</th><th>1</th><th>2</th><th>3</th><th>4</th><th>5</th><th>6</th></tr>';

while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    print '<tr>';
    print '<td>'.$row['YYYY'].'</td>';
    print '<td>'.$row['ANIO1'].'</td>';
    print '<td>'.$row['ANIO2'].'</td>';
    print '<td>'.$row['ANIO3'].'</td>';
    print '<td>'.$row['ANIO4'].'</td>';
    print '<td>'.$row['ANIO5'].'</td>';
    print '<td>'.$row['ANIO6'].'</td>';
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
