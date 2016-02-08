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

<TITLE>Modificar Estudiante</TITLE>

</HEAD>

<BODY>

<!-- Aqui va todo lo chachi -->

<H1>Modificar Estudiante</H1>
<hr/>
<hr/>
<hr/>
<hr/>


<H1>Ingrese el Carnet del Estudiante:</H1>
<form name="form1" method="post" action="r2_modificar1.php">
	 
<label>Carnet:</label>
<input name="carnet" type="text" id="carnet" required>
<br><br>
<input type="submit" name="Submit" value="Modificar">
</form>
<hr/>
<hr/>

<nav >
                    <ul class="sf-menu" id="nav">
                        <li ><a href="rol2.php">Atras</a></li>
                        <li ><a href="logout.php">Logout</a></li>
                    </ul>
                </nav>
            </br>

</BODY>

</HTML> 
