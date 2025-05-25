<?php
include_once '../config/config.php';

// Function to read the last 3 news ordered by publication_date
function readNews($mysqli) {
    $sql = "SELECT * FROM news ORDER BY publication_date DESC LIMIT 3";
    $result = $mysqli->query($sql);
    return $result;
}

// Function to read all news 

function readAllNews($mysqli) {
    $sql = "SELECT * FROM news";
    $result = $mysqli->query($sql);
    return $result;
}




?>