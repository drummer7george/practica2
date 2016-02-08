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

<TITLE>USUARIOS</TITLE>

</HEAD>

<BODY>

<!-- Aqui va todo lo chachi -->

<H1>USUARIOS</H1>
<?php
$nombre = trim($_POST['nombre']);
$apellido = trim($_POST['apellido']);
$username = trim($_POST['username']);
$password = trim($_POST['password']);
$rol=(int)trim($_POST['list']);


$sql2= "SELECT * FROM usuario WHERE username ='".$username."' and rol=".$rol;

  // Preparar la sentencia
$stid2 = oci_parse($conn,$sql2);
//oci_bind_by_name($stid, ':uuu', $username);
//oci_bind_by_name($stid, ':ppp', $password);
//oci_bind_by_name($stid, ':rrr', $rol);
if (!$stid2) {
    $e = oci_error($conn);
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    print("ERROR1...");
}

//ejecuta
oci_execute($stid2);
if (!$stid2) {
    $e = oci_error($stid2);
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    print("ERROR2...");
}

if (($row = oci_fetch_array($stid2, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
	print("Ya exiten datos");
}else{
	print("Ingresado");
	}
$filas=oci_num_rows($stid2);
//print("ss         ".$filas."           ss");
if($filas==0){

$sql= "INSERT INTO USUARIO(username,password,rol,nombre,apellido ) VALUES ('".$username."','".$password."',1,'".$nombre."','".$apellido."')";

$stid = oci_parse($conn,$sql);

if (!$stid) {
    $e = oci_error($conn);
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    print("ERROR1...");
}

//ejecuta
$r=oci_execute($stid);

if($r){
	print("Ingresado");
	}else{
		print("Error al ingresar datos");
		}
	}

?>


<hr/>
<hr/>
<hr/>
<?php
$stid = oci_parse($conn, 'SELECT username,nombre,apellido,rol FROM usuario WHERE rol=1');
if (!$stid) {
    $e = oci_error($conn);
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

// Realizar la lógica de la consulta
$r = oci_execute($stid);
if (!$r) {
    $e = oci_error($stid);
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

// Obtener los resultados de la consulta
print "<table border='1'>\n";
while ($fila = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    print "<tr>\n";
    foreach ($fila as $elemento) {
        print "    <td>" . ($elemento !== null ? htmlentities($elemento, ENT_QUOTES) : "") . "</td>\n";
    }
    print "</tr>\n";
}
print "</table>\n";

oci_free_statement($stid);
?>
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
