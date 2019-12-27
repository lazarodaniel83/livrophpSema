<?php

DEFINE('DB_USER','daniel');
DEFINE('DB_PASSWORD','Ldss#1209');
DEFINE('DB_HOST','localhost');
DEFINE('DB_NAME','LivroPhpSema');
//DEFINE('DB_PORT','3306');

$dbc = @mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) OR die('could not connect to MySQL:'.mysqli_connect_error());

?>