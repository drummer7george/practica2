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

<H1>Crear Administrador de Sistema</H1>

<form name="form1" method="post" action="r2_crear1.php">
	 
<label>Username:</label>
<input name="username" type="text" id="username" required>
<br><br>
<label>Nombre:</label>
<input name="nombre" type="text" id="nombre" required>
<br><br>
<label>Apellido:</label>
<input name="apellido" type="text" id="apellido" required>
<br><br>
<label>Password:</label>
<input name="password" type="password" id="password" required>
<br><br>
<select name="list" id="list" >
  <option value=2 >Adm. Sistema</option>
</select>
<br><br>
<input type="submit" name="Submit" value="Entrar">
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
