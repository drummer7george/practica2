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

<TITLE>Administrador de Base de Datos</TITLE>

</HEAD>

<BODY>
	<hr />
	<br />
	<br />
	<br />

	<center>
<hr />

<!-- Aqui va todo lo chachi -->

<H1>ADMINISTRADOR DE BASE DE DATOS</H1>
<hr />
	<br />
	<br />
		
<hr />
<br />
	<br />
	<br />
	<br />
<ul class="sf-menu" id="nav">
                        <li ><a href="r1_crear.php">Crear cuenta Adinistrador</a></li>
                        <li ><a href="r1_listar.php">Usuarios Registrados</a></li>
</ul>
<br />
	<br />
<hr />
	<br />
	<br />
	<br />
	<br />
	<hr/>
	
	<br />
	<br />
	
	
                    
                    <nav >
                    <ul class="sf-menu" id="nav">
                        <li ><a href="logout.php">Logout</a></li>
                    </ul>
                </nav>
            </br>


</BODY>

</HTML> 
