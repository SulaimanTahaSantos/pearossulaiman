<?php
include_once '../config/config.php';


function readProject($mysqli) {
    $sql = "SELECT * FROM project";
    $result = $mysqli->query($sql);
    return $result;
}
$projects = readProject($mysqli);


?>