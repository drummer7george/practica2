<?php 
session_start();
putEnv("ORACLE_HOME=/u01/app/oracle/product/11.2.0/xe");
putEnv("ORACLE_SID=XE");
putEnv("LD_LIBRARY_PATH=/u01/app/oracle/product/11.2.0/xe/lib"); 
include 'ejemplo.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Check Login</title>
<meta charset = "utf8" />
</head>
 
<body>

<nav>
                    <ul class="sf-menu" id="nav">
                        <li ><a href="inicio.php">Administracion</a></li>
                    </ul>
                </nav>




</body>
</html>