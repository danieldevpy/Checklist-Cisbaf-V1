<?php
//conexão com o servidor

define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DBNAME', 'meubanco');

$conn = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME . ';', USER, PASS);


?>


