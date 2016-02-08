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

<?php
$carnet =(int)trim($_POST['carnet']);


$sql2= "SELECT carnet,nombres, sexo, to_char(fecha_nac,'YYYY-MM-DD') fecha,direccion_origen FROM estudiante WHERE carnet =".$carnet;

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

if (($row = oci_fetch_array($stid2, OCI_ASSOC + OCI_RETURN_NULLS)) == false) {
	print("Estudiante con carnet ingresado no existe");
	
	echo "<br/>" . "<a href='r2_modificar.php'>Atras!</a>";
}else{
	
	
$filas=oci_num_rows($stid2);
//print("ss         ".$filas."           ss");
if($filas==1){
echo "<H1>Modificar Estudiante</H1>";
echo "<br/>";
echo "<br/>";
echo "<form name='form1' method='post' action='r2_modificar2.php'>";
echo "<label>Carnet:</label>";
echo "<input name='carnet' type='text' id='carnet' value='".$row['CARNET']."' required readonly>";
echo "<br><br>";
echo "<label>Nombres:</label>";
echo "<input name='nombres' type='text' id='nombres' value='".$row['NOMBRES']."'  required>";
echo "<br><br>";
echo "<label>Genero</label>";
echo "<select name='sexo' id='sexo' >";
if($row['SEXO']=="M"){
echo "<option value='M' selected>Masculino</option>";
echo "<option value='F' >Femenino</option>";
}else{
	echo "<option value='M' >Masculino</option>";
echo "<option value='F' selected>Femenino</option>";
	}
echo "</select>";
echo "<br><br>";
echo "<label>Fecha Nac.</label>";
echo "<input type='date' name='fecha' id='fecha'  value='.".$row['FECHA']."'>";
echo "<br><br>";
echo "<label>Direccion de Origen:</label>";
echo "<input name='dir' type='text' id='dir' value='".$row['DIRECCION_ORIGEN']."'required>";
echo "<br><br>";
echo "<input type='submit' name='Submit' value='Entrar'>";
echo "</form>";
}
}
?>
<hr/>
<hr/>

<nav >
                    <ul class="sf-menu" id="nav">
                        <li ><a href="r2_modificar.php">Atras</a></li>
                        <li ><a href="logout.php">Logout</a></li>
                    </ul>
                </nav>
            </br>

</BODY>
</HTML> 
