<?php
include_once '../config/config.php';

function readTestimony($mysqli) {
    $sql = "SELECT * FROM testimony";
    $result = $mysqli->query($sql);
    return $result;
}

?>