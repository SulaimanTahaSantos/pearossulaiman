<?php
// Configuración de base de datos para Railway
$host = $_ENV['DB_HOST'] ?? getenv('DB_HOST') ?? 'mysql-sulaiman.alwaysdata.net';
$db = $_ENV['DB_NAME'] ?? getenv('DB_NAME') ?? 'sulaiman_crud_uf3';
$user = $_ENV['DB_USER'] ?? getenv('DB_USER') ?? 'sulaiman_';
$password = $_ENV['DB_PASSWORD'] ?? getenv('DB_PASSWORD') ?? 'APTItude01';

// Configurar timezone
date_default_timezone_set('Europe/Madrid');

try {
    $mysqli = new mysqli($host, $user, $password, $db);
    
    // Configurar charset
    $mysqli->set_charset("utf8mb4");
    
    if ($mysqli->connect_error) {
        error_log("Error de conexión a la base de datos: " . $mysqli->connect_error);
        throw new Exception("Error de conexión a la base de datos");
    }
} catch (Exception $e) {
    // En producción, mostrar mensaje genérico
    if (getenv('APP_ENV') === 'production') {
        die("Error interno del servidor. Por favor, contacte al administrador.");
    } else {
        die("Conexión fallida: " . $e->getMessage());
    }
}
?>
