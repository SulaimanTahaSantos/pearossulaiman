<?php
session_start();
require_once '../../../config/config.php';
include_once '../../../controller/adminController.php';

// 1. Verificar que el rol sea administrador
if ($_SESSION['user_rol'] !== 'admin') {
    echo 'No tienes permisos para acceder a esta página';
    exit;
}

// 2. Eliminar el testimonio
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $DeleteTestimonial = deleteTestimonial($mysqli, $id);

    // 3. Esperar 2 segundos y redirigir
    echo "<script>
            setTimeout(function() {
                window.location.href = '../adminPanel.php';
            }, 2000);
          </script>";

    echo "Eliminando testimonio...";
}
?>
