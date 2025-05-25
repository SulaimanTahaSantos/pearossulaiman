<?php
session_start();
include_once '../config/config.php';
include_once '../controller/commentsController.php';

// Verifica si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger datos del formulario
    $comment = $_POST['comment'];
    $id_news = $_POST['id_news']; // Recoger el id de la noticia
    
    // Obtener el id del usuario si está logueado (esto depende de tu implementación de sesión)
    $id_user = $_SESSION['user_id'] ?? 0; // Esto depende de cómo manejes la autenticación
    
    // Insertar el comentario
    if (insertComment($mysqli, $id_news, $id_user, $comment)) {
        header("Location: blog-single.php?id=$id_news");
        exit;
    } else {
        echo "Error al insertar el comentario.";
    }
}
?>
