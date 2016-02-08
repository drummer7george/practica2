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

<TITLE>Modificado</TITLE>

</HEAD>

<BODY>

<!-- Aqui va todo lo chachi -->

<hr/>
<hr/>
<hr/>

<?php
$carnet = (int)trim($_POST['carnet']);
$nombres = trim($_POST['nombres']);
$sexo = trim($_POST['sexo']);
$fecha = trim($_POST['fecha']);
$direccion = trim($_POST['dir']);



$sql2= "  UPDATE ESTUDIANTE SET nombres='".$nombres."',sexo='".$sexo."',fecha_nac=to_date('".$fecha."','YYYY-MM-DD'),direccion_origen='".$direccion."' WHERE carnet=".$carnet;

  // Preparar la sentencia
$stid2 = oci_parse($conn,$sql2);
if (!$stid2) {
    $e = oci_error($conn);
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    print("ERROR1...");
}

//ejecuta
$r=oci_execute($stid2);
if ($r) {
    print("DATOS ACTUALIZADOS");
}else{
	print("ERROR: DATOS NO ACTUALIZADOS");
	}



oci_free_statement($stid2);
?>


<hr/>
<hr/>
<hr/>
<hr/>
<hr/>

<nav >
                    <ul class="sf-menu" id="nav">
                        <li ><a href="r1_crear.php">Crear Nuevo</a></li>
                        <li ><a href="logout.php">Logout</a></li>
                    </ul>
                </nav>
            </br>


</BODY>

</HTML> 
