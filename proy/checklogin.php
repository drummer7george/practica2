<?php
    
   /* start the session */
   session_start();
   putEnv("ORACLE_HOME=/u01/app/oracle/product/11.2.0/xe");
   putEnv("ORACLE_SID=XE");
   putEnv("LD_LIBRARY_PATH=/u01/app/oracle/product/11.2.0/xe/lib"); 
   include 'conexion.php' ;


  // sent from form
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);
  $rol=(int)trim($_POST['list']);
  //print("usuario".$username."password".$password."rol".$rol);
   
  $sql= "SELECT * FROM usuario WHERE username ='".$username."' and password='".$password."' and rol=".$rol;

  // Preparar la sentencia
$stid = oci_parse($conn,$sql);
//oci_bind_by_name($stid, ':uuu', $username);
//oci_bind_by_name($stid, ':ppp', $password);
//oci_bind_by_name($stid, ':rrr', $rol);
if (!$stid) {
    $e = oci_error($conn);
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    print("ERROR1...");
}

//ejecuta
oci_execute($stid);
if (!$stid) {
    $e = oci_error($stid);
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    print("ERROR2...");
}

if (($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
	print("si ngreso");
}else{
	print("error");
	}
$filas=oci_num_rows($stid);
//print("ss         ".$filas."           ss");
if($filas==1){
   $_SESSION['loggedin'] = true;
   $_SESSION['username'] = $username;
   $_SESSION['rol']=$rol;
   //$_SESSION['start'] = time();
   //$_SESSION['expire'] = $_SESSION['start'] + (10 * 60) ;

   $c = oci_fetch_array($stid);
   print("exito");

   if($rol==1){
   header("location:rol1.php");

}elseif($rol==2){
   header("location:rol2.php");
}elseif($rol==3){
    header("location:rol3.php");
}

}else{

        print("<br/>Username o Password estan incorrectos.<br>");
        print("<a href='main_login.php'>Volver a Intentarlo</a>");
        oci_free_statement($stid);
        $_SESSION = array();
        session_destroy();

}   
?>
  
