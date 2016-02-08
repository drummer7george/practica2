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

<TITLE>CONSULTA 8</TITLE>

</HEAD>

<BODY>

<!-- Aqui va todo lo chachi -->

<H1>CONSULTA 8</H1>
<hr/>
<?php


$consulta = "SELECT DECODE (E.SEXO,'M','MASCULINO','F','FEMENINO') SEXO,
DECODE( SUM( CASE WHEN  D.NOMBRE = 'GUATEMALA' THEN 1 ELSE 0 END),0,'NINGUNO', SUM( CASE WHEN  D.NOMBRE = 'GUATEMALA' THEN 1 ELSE 0 END) ) GUATEMALA,
DECODE( SUM( CASE WHEN  D.NOMBRE = 'IZABAL' THEN 1 ELSE 0 END),0,'NINGUNO',SUM( CASE WHEN  D.NOMBRE = 'IZABAL' THEN 1 ELSE 0 END) ) IZABAL,
DECODE( SUM( CASE WHEN  D.NOMBRE = 'PETEN' THEN 1 ELSE 0 END),0,'NINGUNO',SUM( CASE WHEN  D.NOMBRE = 'PETEN' THEN 1 ELSE 0 END) ) PETEN
FROM ESTUDIANTE E, MUNICIPIO M, DEPARTAMENTO D
WHERE E.MUNICIPIO_ID = M.ID_MUNICIPIO AND M.DEPARTAMENTO_ID = D.ID_DEPTO
GROUP BY E.SEXO";

$stid = oci_parse ($conn, $consulta);

oci_execute($stid);

print '<table border="1">';
print '<tr><th>SEXO</th><th>GUATEMALA</th><th>IZABAL</th><th>PETEN</th></tr>';

while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    print '<tr>';
    print '<td>'.$row['SEXO'].'</td>';
    print '<td>'.$row['GUATEMALA'].'</td>';
    print '<td>'.$row['IZABAL'].'</td>';
    print '<td>'.$row['PETEN'].'</td>';
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
