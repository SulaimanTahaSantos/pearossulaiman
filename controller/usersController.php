<?php
include_once '../config/config.php';

function readUsers($mysqli, $email){
$result = $mysqli->query("SELECT * FROM users WHERE email = '$email'");
return $result;
}

function createUser($mysqli, $name, $surname, $email, $password, $avatar, $age, $job){
        $passwordHashed = password_hash($password, PASSWORD_DEFAULT);

      // Preparar la consulta antes de insertar para evitar el SQL injection
    $stmt = $mysqli->prepare(
        "INSERT INTO users (name, email, password, rol, data_registre, surname, avatar, age, job) 
        VALUES (?, ?, ?, 'user', CURDATE(), ?, ?, ?, ?)"
    );

    // Comprobar que la preparación tuvo éxito
    if (!$stmt) {
        die('Error en la preparación de la consulta: ' . $mysqli->error);
        exit;
    }

    // Enlazar los parámetros (nota que ahora solo son 8 parámetros)
    $stmt->bind_param('sssssis', $name, $email, $passwordHashed, $surname, $avatar, $age, $job);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo 'Usuario registrado correctamente';
    } else {
        echo 'Error al registrar el usuario';
    }

    // Cerrar la consulta
    $stmt->close();
    $mysqli->close();
}

?>