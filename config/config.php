<?php
$host = 'mysql-sulaiman.alwaysdata.net';  
$db = 'sulaiman_crud_uf3';  
$user = 'sulaiman_'; 
$password = 'APTItude01';

$mysqli = new mysqli($host, $user, $password, $db);

if ($mysqli->connect_error) {
    die("Conexión fallida: " . $mysqli->connect_error);
}
?>
