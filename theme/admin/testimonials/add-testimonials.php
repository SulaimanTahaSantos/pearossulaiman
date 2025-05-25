<?php
session_start();
require_once '../../../config/config.php';
include_once '../../../controller/adminController.php';

// 1. verificar que el rol sea administrador
if ($_SESSION['user_rol'] !== 'admin') {
    echo 'No tienes permisos para acceder a esta página';
    exit;
}

if (isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['testimony']) && isset($_POST['image']) && isset($_POST['date'])) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $testimony = $_POST['testimony'];
    $image = $_POST['image'];
    $date = $_POST['date'];

    $addTestimony = addTestimonial($mysqli, $name, $surname, $testimony, $image, $date);
}
?>
