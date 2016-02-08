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

<TITLE>Crear Usuario</TITLE>

</HEAD>

<BODY>

<!-- Aqui va todo lo chachi -->
<center>
<H1>CONSULTAS</H1>

<hr/>
<hr/>

<nav >
                    <ul align="center" class="sf-menu" id="nav">
                        <li ><a href="r2_c1.php">Consulta 1</a></li>
                        <li ><a href="r2_c2.php">Consulta 2</a></li>
                        <li ><a href="r2_c3.php">Consulta 3</a></li>
                        <li ><a href="r2_c4.php">Consulta 4</a></li>
                        <li ><a href="r2_c6.php">Consulta 6</a></li>
                        <li ><a href="r2_c7.php">Consulta 7</a></li>
                        <li ><a href="r2_c8.php">Consulta 8</a></li>
                        <li ><a href="r2_c10.php">Consulta 10</a></li>
                        <li ><a href="rol2.php">Principal</a></li>
                        <li ><a href="logout.php">Logout</a></li>
                    </ul>
                </nav>
            </br>
            </center>

</BODY>

</HTML> 
