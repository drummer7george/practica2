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

<TITLE>CONSULTA 6</TITLE>

</HEAD>

<BODY>

<!-- Aqui va todo lo chachi -->

<H1>CONSULTA 6</H1>
<hr/>
<?php


$consulta = "select * from (
select to_char(fecha_visita, 'DAY', 'NLS_DATE_LANGUAGE=SPANISH') dia , to_char(fecha_visita,'YYYY') aa from visita
where to_number(to_char(fecha_visita,'YYYY'))>=2001 and to_number(to_char(fecha_visita,'YYYY'))<=2003
order by dia   
)
pivot 
(
   count(aa) 
   for aa in ('2001' as Y2001,'2002' as Y2002 ,'2003' as Y2003)
)
order by dia";

$stid = oci_parse ($conn, $consulta);

oci_execute($stid);

print '<table border="1">';
print '<tr><th>DIA</th><th>2001</th><th>2002</th><th>2003</th></tr>';

while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    print '<tr>';
    print '<td>'.$row['DIA'].'</td>';
    print '<td>'.$row['Y2001'].'</td>';
    print '<td>'.$row['Y2002'].'</td>';
    print '<td>'.$row['Y2003'].'</td>';
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
