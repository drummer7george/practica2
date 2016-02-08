<?php

putEnv("ORACLE_HOME=/u01/app/oracle/product/11.2.0/xe");
putEnv("ORACLE_SID=XE");
putEnv("LD_LIBRARY_PATH=/u01/app/oracle/product/11.2.0/xe/lib");



$conn = oci_connect('practica2', 'jorge', 'localhost/xe');
if (!$conn) {
    print("FUERA DE LINEA");
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    print('$e');
} else {
    print("EN LINEA");
}
?>
