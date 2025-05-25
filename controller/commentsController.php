<?php
session_start();
include_once '../config/config.php';


function readComments($mysqli, $id_news) {
    $sql = "
    SELECT 
        c.comment, c.date, u.avatar, u.name
    FROM 
        comentarios c
    LEFT JOIN 
        users u ON c.id_user_id = u.id
    WHERE 
        c.id_news_id = $id_news
    ";
    $result = $mysqli->query($sql);
    
    if ($result) {
        return $result; 
    } else {
        return null; 
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
}

function insertComment ($mysqli, $id_news, $id_user, $comment) {
    $sql = "
    INSERT INTO 
        comentarios (id_news_id, id_user_id, comment, date)
    VALUES 
        ($id_news, $id_user, '$comment', NOW())
    ";
    $result = $mysqli->query($sql);
    
    if ($result) {
        return $result; 
    } else {
        return null; 
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
}



?>