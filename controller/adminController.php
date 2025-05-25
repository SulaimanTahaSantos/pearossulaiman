<?php


// funcion para cargar testimonios en el panel de administrador

function readTestimonios($mysqli)
{
    $resultTestimonios = $mysqli->query("SELECT * FROM testimony");
    $testimonios = $resultTestimonios->fetch_all(MYSQLI_ASSOC);
    return $testimonios;
}

// funcion para eliminar testimonios

function deleteTestimonial($mysqli, $id)
{
    $stmt = $mysqli->prepare("DELETE FROM testimony WHERE id = ?");
    $stmt->bind_param('i', $id);
    if (!$stmt->execute()) {
        die('Error en la ejecución de la consulta: ' . $stmt->error);
        exit;
    }
    $stmt->close();
    $mysqli->close();
}

// funcion para agregar testimonios

function addTestimonial($mysqli, $name, $surname, $testimony, $image, $date)
{
    $stmt = $mysqli->prepare(
        "INSERT INTO testimony (name, surname, testimony, image, date) 
        VALUES (?, ?, ?, ?, ?)"
    );

    // 5. comprobar que la preparación tuvo éxito
    if (!$stmt) {
        die('Error en la preparación de la consulta: ' . $mysqli->error);
        exit;
    }

    // 6. enlazar los parámetros
    $stmt->bind_param('sssss', $name, $surname, $testimony, $image, $date);

    // 7. ejecutar la consulta
    if ($stmt->execute()) {
        echo '';
    } else {
        echo 'Error al eliminar el testimonio';
    }

    // 8. cerrar la consulta
    $stmt->close();
}

// funcion para editar testimonios

function editTestimonial($mysqli, $id, $name, $surname, $testimony, $image, $date)
{
    $stmt = $mysqli->prepare(
        "UPDATE testimony SET name = ?, surname = ?, testimony = ?, image = ?, date = ? WHERE id = ?"
    );

    // 5. comprobar que la preparación tuvo éxito
    if (!$stmt) {
        die('Error en la preparación de la consulta: ' . $mysqli->error);
        exit;
    }

    $stmt->bind_param('sssssi', $name, $surname, $testimony, $image, $date, $id);

    if ($stmt->execute()) {
        echo '';
    } else {
        echo 'Error al editar el testimonio';
    }

    $stmt->close();
}

// Funciones de noticias

// funcion para cargar noticias en el panel de administrador
function readNews($mysqli)
{
    $resultNews = $mysqli->query("SELECT * FROM news");
    $news = $resultNews->fetch_all(MYSQLI_ASSOC);
    return $news;
}

// funcion para eliminar noticias

function deleteNews($mysqli, $id)
{
    $stmt = $mysqli->prepare("DELETE FROM news WHERE id = ?");
    $stmt->bind_param('i', $id);
    if (!$stmt->execute()) {
        die('Error en la ejecución de la consulta: ' . $stmt->error);
        exit;
    }
    $stmt->close();
    $mysqli->close();
}

// funcion para agregar noticias

function addNews($mysqli, $title, $subtitle, $body, $publication_date, $descripcion)
{
    // Preparar la consulta SQL para insertar los datos
    $stmt = $mysqli->prepare(
        "INSERT INTO news (title, subititle, body, publication_date, descripcion) 
        VALUES (?, ?, ?, ?, ?)"
    );

    // 5. Comprobar que la preparación tuvo éxito
    if (!$stmt) {
        die('Error en la preparación de la consulta: ' . $mysqli->error);
        exit;
    }

    // 6. Enlazar los parámetros
    $stmt->bind_param('sssss', $title, $subtitle, $body, $publication_date, $descripcion);

    // 7. Ejecutar la consulta
    if ($stmt->execute()) {
        echo 'Noticia guardada correctamente.';
    } else {
        echo 'Error al guardar la noticia: ' . $stmt->error;
    }

    // 8. Cerrar la consulta
    $stmt->close();
}

function editNews($mysqli, $id, $title, $subititle, $body, $publicationDate, $descripcion)
{
    $stmt = $mysqli->prepare(
        "UPDATE news SET title = ?, subititle = ?, body = ?, publication_date = ?, descripcion = ? WHERE id = ?"
    );

    // 5. comprobar que la preparación tuvo éxito
    if (!$stmt) {
        die('Error en la preparación de la consulta: ' . $mysqli->error);
        exit;
    }

    $stmt->bind_param('sssssi', $title, $subititle, $body, $publicationDate, $descripcion, $id);

    if ($stmt->execute()) {
        echo '';
    } else {
        echo 'Error al editar la noticia';
    }

    $stmt->close();
}

// Funciones para borrar editar leer e insertar proyectos

function readProjects($mysqli)
{
    $resultProjects = $mysqli->query("SELECT * FROM projects");
    $projects = $resultProjects->fetch_all(MYSQLI_ASSOC);
    return $projects;
}

function deleteProject($mysqli, $id)
{
    $stmt = $mysqli->prepare("DELETE FROM projects WHERE id = ?");
    $stmt->bind_param('i', $id);
    if (!$stmt->execute()) {
        die('Error en la ejecución de la consulta: ' . $stmt->error);
        exit;
    }
    $stmt->close();
    $mysqli->close();
}

function editProject($mysqli, $id, $title, $description, $url, $image)
{
    $stmt = $mysqli->prepare(
        "UPDATE projects SET title = ?, description = ?, url = ?, thumbnail = ? WHERE id = ?"
    );

    // 5. comprobar que la preparación tuvo éxito
    if (!$stmt) {
        die('Error en la preparación de la consulta: ' . $mysqli->error);
        exit;
    }

    $stmt->bind_param('ssssi', $title, $description, $url, $image, $id);

    if ($stmt->execute()) {
        echo '';
    } else {
        echo 'Error al editar el proyecto';
    }

    $stmt->close();
}

function addProject($mysqli, $title, $description, $url, $image)
{
    $stmt = $mysqli->prepare(
        "INSERT INTO projects (title, description, url, thumbnail) 
        VALUES (?, ?, ?, ?)"
    );

    // 5. comprobar que la preparación tuvo éxito
    if (!$stmt) {
        die('Error en la preparación de la consulta: ' . $mysqli->error);
        exit;
    }

    // 6. enlazar los parámetros
    $stmt->bind_param('ssss', $title, $description, $url, $image);

    // 7. ejecutar la consulta
    if ($stmt->execute()) {
        echo '';
    } else {
        echo 'Error al eliminar el proyecto';
    }

    // 8. cerrar la consulta
    $stmt->close();
}

// Funciones para borrar editar leer e insertar usuarios

function readUsers($mysqli)
{
    $resultUsers = $mysqli->query("SELECT * FROM users");
    $users = $resultUsers->fetch_all(MYSQLI_ASSOC);
    return $users;
}

function deleteUsers($mysqli, $id)
{
    $stmt = $mysqli->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param('i', $id);
    if (!$stmt->execute()) {
        die('Error en la ejecución de la consulta: ' . $stmt->error);
        exit;
    }
    $stmt->close();
    $mysqli->close();
}

// La funcion addUsers debe tener los campos name, email, password,rol, data_registre, surname, avatar, age, job

function addUsers($mysqli, $name, $email, $password, $rol, $data_registre, $surname, $avatar, $age, $job)
{
    $stmt = $mysqli->prepare(
        "INSERT INTO users (name, email, password, rol, data_registre, surname, avatar, age, job) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"
    );

    // 5. comprobar que la preparación tuvo éxito
    if (!$stmt) {
        die('Error en la preparación de la consulta: ' . $mysqli->error);
        exit;
    }

    // 6. enlazar los parámetros
    $stmt->bind_param('ssssssssi', $name, $email, $password, $rol, $data_registre, $surname, $avatar, $age, $job);

    // 7. ejecutar la consulta
    if ($stmt->execute()) {
        echo '';
    } else {
        echo 'Error al eliminar el usuario';
    }

    // 8. cerrar la consulta
    $stmt->close();
}


// La funcion editUsers debe tener los campos name, email, password,rol, data_registre, surname, avatar, age, job 

function editUsers($mysqli, $id, $name, $email, $password, $rol, $data_registre, $surname, $avatar, $age, $job)
{
    $stmt = $mysqli->prepare(
        "UPDATE users SET name = ?, email = ?, password = ?, rol = ?, data_registre = ?, surname = ?, avatar = ?, age = ?, job = ? WHERE id = ?"
    );

    // 5. comprobar que la preparación tuvo éxito
    if (!$stmt) {
        die('Error en la preparación de la consulta: ' . $mysqli->error);
        exit;
    }

    $stmt->bind_param('sssssssssi', $name, $email, $password, $rol, $data_registre, $surname, $avatar, $age, $job, $id);

    if ($stmt->execute()) {
        echo '';
    } else {
        echo 'Error al editar el usuario';
    }

    $stmt->close();
}


// Ahora funciones para añadir comentarios

function readComments($mysqli)
{
    $resultComments = $mysqli->query("SELECT * FROM comentarios");
    $comments = $resultComments->fetch_all(MYSQLI_ASSOC);
    return $comments;
}

function deleteComments($mysqli, $id)
{
    $stmt = $mysqli->prepare("DELETE FROM comentarios WHERE id = ?");
    $stmt->bind_param('i', $id);
    if (!$stmt->execute()) {
        die('Error en la ejecución de la consulta: ' . $stmt->error);
        exit;
    }
    $stmt->close();
    $mysqli->close();
}

function editComments($mysqli, $id, $comentario, $fecha)
{
    $stmt = $mysqli->prepare(
        "UPDATE comentarios SET comment = ?, date = ? WHERE id = ?"
    );

    // 5. comprobar que la preparación tuvo éxito
    if (!$stmt) {
        die('Error en la preparación de la consulta: ' . $mysqli->error);
        exit;
    }

    $stmt->bind_param('ssi', $comentario, $fecha, $id);

    if ($stmt->execute()) {
        echo '';
    } else {
        echo 'Error al editar el comentario';
    }

    $stmt->close();
}
