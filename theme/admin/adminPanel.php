<?php
session_start();
require_once '../../config/config.php';
include_once '../../controller/adminController.php';

// 1. Verificar que el rol sea administrador
if ($_SESSION['user_rol'] !== 'admin') {
    echo 'No tienes permisos para acceder a esta página';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $testimony = $_POST['testimony'];
    $date = $_POST['date'];

    $uploadDir = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR;  // Usar ruta correcta desde el directorio actual

    $testimonio = '';

    // Verificar si se subió una imagen
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileName = $_FILES['image']['name'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        $allowedExtensions = ['jpg', 'png', 'jpeg', 'gif', 'svg'];

        if (in_array($fileExtension, $allowedExtensions)) {
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            $testimonioDir = $uploadDir . 'testimonio' . DIRECTORY_SEPARATOR;

            if (!is_dir($testimonioDir)) {
                mkdir($testimonioDir, 0777, true);
            }

            $destPath = $testimonioDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $destPath)) {
                $testimonio = $newFileName;  // Almacenar el nombre del archivo
            } else {
                $error_message = 'Hubo un error al subir la imagen del testimonio';
            }
        } else {
            $error_message = 'Formato de archivo no permitido. Solo se permiten imágenes JPG, PNG, JPEG, GIF o SVG';
        }
        if (empty($error_message)) {
            // Asegúrate de pasar el nombre de la imagen a la función de guardar
            $addTestimonyFile = addTestimonial($mysqli, $name, $surname, $testimony, $testimonio, $date);
        } else {
            // Mostrar error si algo salió mal
            echo $error_message;
        }
    }
}



// Guardamos el formulario de insert de noticias

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title']) && isset($_POST['subititle']) && isset($_FILES['body']) && isset($_POST['publication_date']) && isset($_POST['descripcion'])) {
    $title = $_POST['title'];
    $subtitle = $_POST['subititle'];
    $body = $_FILES['body'];
    $publication_date = $_POST['publication_date'];
    $descripcion = $_POST['descripcion'];

    // Ruta para subir archivos
    $uploadDir = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR;

    $imageName = '';

    if (isset($body) && $body['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $body['tmp_name'];
        $fileName = $body['name'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        $allowedExtensions = ['jpg', 'png', 'jpeg', 'gif', 'svg'];

        if (in_array($fileExtension, $allowedExtensions)) {
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            $imageDir = $uploadDir . 'news' . DIRECTORY_SEPARATOR;

            if (!is_dir($imageDir)) {
                mkdir($imageDir, 0777, true);
            }

            $destPath = $imageDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $destPath)) {
                $imageName = $newFileName;
            } else {
                $error_message = 'Hubo un error al subir la imagen.';
            }
        } else {
            $error_message = 'Formato de archivo no permitido. Solo se permiten imágenes JPG, PNG, JPEG, GIF o SVG.';
        }
        if (empty($error_message)) {
            // Asegúrate de pasar el nombre de la imagen a la función de guardar
            $addNews = addNews($mysqli, $title, $subtitle, $imageName, $publication_date, $descripcion);
            echo $title;
            echo $subtitle;
            echo $imageName;
        } else {
            // Mostrar error si algo salió mal
            echo $error_message;
        }
    }
}

// Proyectos
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title']) && isset($_POST['description']) && isset($_POST['url']) && isset($_FILES['thumbnail'])) {
    $title = $_POST['title'];
    $description = $_POST['description']; // Corregido de 'subititle' a 'subtitle'
    $url = $_POST['url'];
    $thumbnail = $_FILES['thumbnail'];


    // Ruta para subir archivos
    $uploadDir = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR;

    $imageName = '';

    if (isset($thumbnail) && $thumbnail['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $thumbnail['tmp_name'];
        $fileName = $thumbnail['name'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        $allowedExtensions = ['jpg', 'png', 'jpeg', 'gif', 'svg'];

        if (in_array($fileExtension, $allowedExtensions)) {
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            $imageDir = $uploadDir . 'projects' . DIRECTORY_SEPARATOR;

            if (!is_dir($imageDir)) {
                mkdir($imageDir, 0777, true);
            }

            $destPath = $imageDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $destPath)) {
                $imageName = $newFileName;
            } else {
                $error_message = 'Hubo un error al subir la imagen.';
            }
        } else {
            $error_message = 'Formato de archivo no permitido. Solo se permiten imágenes JPG, PNG, JPEG, GIF o SVG.';
        }
        if (empty($error_message)) {
            // Asegúrate de pasar el nombre de la imagen a la función de guardar
            $addProjects = addProject($mysqli, $title, $description, $url, $imageName);
        } else {
            // Mostrar error si algo salió mal
            echo $error_message;
        }
    }
}

// usuarios
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['rol']) && isset($_POST['data_register']) && isset($_POST['surname']) && isset($_FILES['avatar']) && isset($_POST['age']) && isset($_POST['job'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $rol = $_POST['rol'];
    $data_registre = $_POST['data_register'];
    $surname = $_POST['surname'];
    $avatar = $_FILES['avatar'];
    $age = $_POST['age'];
    $job = $_POST['job'];


    // Ruta para subir archivos
    $uploadDir = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR;

    $imageName = '';

    if (isset($avatar) && $avatar['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $avatar['tmp_name'];
        $fileName = $avatar['name'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        $allowedExtensions = ['jpg', 'png', 'jpeg', 'gif', 'svg'];

        if (in_array($fileExtension, $allowedExtensions)) {
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            $imageDir = $uploadDir . 'userAvatar' . DIRECTORY_SEPARATOR;

            if (!is_dir($imageDir)) {
                mkdir($imageDir, 0777, true);
            }

            $destPath = $imageDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $destPath)) {
                $imageName = $newFileName;
            } else {
                $error_message = 'Hubo un error al subir la imagen.';
            }
        } else {
            $error_message = 'Formato de archivo no permitido. Solo se permiten imágenes JPG, PNG, JPEG, GIF o SVG.';
        }
        if (empty($error_message)) {
            // Asegúrate de pasar el nombre de la imagen a la función de guardar
            $addUsers = addUsers($mysqli, $name, $email, $password, $rol, $data_registre, $surname, $imageName, $age, $job);
        } else {
            // Mostrar error si algo salió mal
            echo $error_message;
        }
    }
}

// 2. Mostramos de momento solo los testimonios
$testimony = readTestimonios($mysqli);
$news = readNews($mysqli);
$projects = readProjects($mysqli);
$users = readUsers($mysqli);
$comments = readComments($mysqli);



?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administrador</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f4f4f4;
        }

        a {
            color: red;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .section {
            display: none;
        }

        .section.active {
            display: block;
        }

        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>

<body class="bg-gray-100 p-5">
    <h1 class="text-3xl font-bold mb-5">Panel de Administrador</h1>
    <button type="button" class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
        <a href="../index.php">Home</a>
    </button>
    <a href="../uploads/"></a>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
        <div class="card bg-white rounded-lg shadow-md p-6 cursor-pointer" onclick="showSection('testimonios')">
            <div class="flex flex-col items-center">
                <svg class="w-12 h-12 text-blue-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                </svg>
                <h3 class="text-xl font-semibold text-center">Testimonios</h3>
                <p class="text-gray-500 text-center mt-2"><?php echo count($testimony); ?> registros</p>
            </div>
        </div>

        <div class="card bg-white rounded-lg shadow-md p-6 cursor-pointer" onclick="showSection('noticias')">
            <div class="flex flex-col items-center">
                <svg class="w-12 h-12 text-green-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                </svg>
                <h3 class="text-xl font-semibold text-center">Noticias</h3>
                <p class="text-gray-500 text-center mt-2"><?php echo count($news); ?> registros</p>
            </div>
        </div>

        <div class="card bg-white rounded-lg shadow-md p-6 cursor-pointer" onclick="showSection('proyectos')">
            <div class="flex flex-col items-center">
                <svg class="w-12 h-12 text-purple-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                <h3 class="text-xl font-semibold text-center">Proyectos</h3>
                <p class="text-gray-500 text-center mt-2"><?php echo count($projects); ?> registros</p>
            </div>
        </div>

        <div class="card bg-white rounded-lg shadow-md p-6 cursor-pointer" onclick="showSection('usuarios')">
            <div class="flex flex-col items-center">
                <svg class="w-12 h-12 text-yellow-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                <h3 class="text-xl font-semibold text-center">Usuarios</h3>
                <p class="text-gray-500 text-center mt-2"><?php echo count($users); ?> registros</p>
            </div>
        </div>

        <div class="card bg-white rounded-lg shadow-md p-6 cursor-pointer" onclick="showSection('comentarios')">
            <div class="flex flex-col items-center">
                <svg class="w-12 h-12 text-red-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                </svg>
                <h3 class="text-xl font-semibold text-center">Comentarios</h3>
                <p class="text-gray-500 text-center mt-2"><?php echo count($comments); ?> registros</p>
            </div>
        </div>
    </div>

    <div id="sections-container" class="mt-8">
        <div id="testimonios" class="section">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold">Testimonios</h2>
                    <button onclick="openModal()" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                        Agregar Testimonio
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="py-3 px-4 text-left">Nombre</th>
                                <th class="py-3 px-4 text-left">Apellidos</th>
                                <th class="py-3 px-4 text-left">Testimonio</th>
                                <th class="py-3 px-4 text-left">Imagen</th>
                                <th class="py-3 px-4 text-left">Fecha</th>
                                <th class="py-3 px-4 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($testimony as $testimonio) : ?>
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="py-3 px-4"><?php echo htmlspecialchars($testimonio['name']); ?></td>
                                    <td class="py-3 px-4"><?php echo htmlspecialchars($testimonio['surname']); ?></td>
                                    <td class="py-3 px-4"><?php echo htmlspecialchars($testimonio['testimony']); ?></td>
                                    <td class="py-3 px-4 relative group">
                                        <div class="flex items-center">
                                            <span>
                                                <?php echo htmlspecialchars($testimonio['image']); ?>
                                            </span>
                                            <!-- Improved hover image preview -->
                                            <div class="hidden opacity-0 scale-95 absolute z-10 top-0 left-[60%] -ml-16 bg-white border border-gray-200 shadow-xl p-2 rounded-lg w-36 h-36 transform transition-all duration-300 ease-in-out group-hover:block group-hover:opacity-100 group-hover:scale-100">
                                                <div class="relative w-full h-full overflow-hidden rounded-md">
                                                    <img src="../uploads/testimonio/<?php echo htmlspecialchars($testimonio['image']); ?>"
                                                        alt="Vista previa"
                                                        class="w-full h-full object-cover rounded-md transition-transform duration-300 hover:scale-110">
                                                    <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-60 text-white text-xs py-1 px-2 truncate">
                                                        <?php echo htmlspecialchars($testimonio['image']); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3 px-4"><?php echo htmlspecialchars($testimonio['date']); ?></td>
                                    <td class="py-3 px-4 flex justify-center gap-3">
                                        <a href="./testimonials/delete-testimonials.php?id=<?php echo $testimonio['id']; ?>" class="text-red-500 hover:text-red-700 transition-colors">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </a>
                                        <a href="./testimonials/edit-testimonials.php?id=<?php echo $testimonio['id']; ?>" class="text-blue-500 hover:text-blue-700 transition-colors">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

        <div id="noticias" class="section">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold">Noticias</h2>
                    <button onclick="openModalNoticias()" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                        Agregar Noticia
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="py-3 px-4 text-left">Titulo</th>
                                <th class="py-3 px-4 text-left">Subtitulo</th>
                                <th class="py-3 px-4 text-left">Imagen</th>
                                <th class="py-3 px-4 text-left">Fecha de publicación</th>
                                <th class="py-3 px-4 text-left">Descripción</th>
                                <th class="py-3 px-4 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($news as $new) : ?>
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="py-3 px-4"><?php echo htmlspecialchars($new['title']); ?></td>
                                    <td class="py-3 px-4"><?php echo htmlspecialchars($new['subititle']); ?></td>
                                    <td class="py-3 px-4 relative group">
                                        <div class="flex items-center">
                                            <span>
                                                <?php echo htmlspecialchars($new['body']); ?>
                                            </span>
                                            <!-- Improved hover image preview -->
                                            <div class="hidden opacity-0 scale-95 absolute z-10 top-0 left-[60%] -ml-16 bg-white border border-gray-200 shadow-xl p-2 rounded-lg w-36 h-36 transform transition-all duration-300 ease-in-out group-hover:block group-hover:opacity-100 group-hover:scale-100">
                                                <div class="relative w-full h-full overflow-hidden rounded-md">
                                                    <img src="../uploads/news/<?php echo htmlspecialchars($new['body']); ?>"
                                                        alt="Vista previa"
                                                        class="w-full h-full object-cover rounded-md transition-transform duration-300 hover:scale-110">
                                                    <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-60 text-white text-xs py-1 px-2 truncate">
                                                        <?php echo htmlspecialchars($news['body']); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    </td>
                                    <td class="py-3 px-4 max-w-xs">
                                        <div class="truncate" title="<?php echo htmlspecialchars($new['publication_date']); ?>">
                                            <?php echo htmlspecialchars($new['publication_date']); ?>
                                        </div>
                                    </td>
                                    <td class="py-3 px-4 max-w-xs">
                                        <div class="truncate" title="<?php echo htmlspecialchars($new['descripcion']); ?>">
                                            <?php echo htmlspecialchars($new['descripcion']); ?>
                                        </div>
                                    </td>
                                    <td class="py-3 px-4 flex justify-center gap-3">
                                        <a href="./news/delete-news.php?id=<?php echo $new['id']; ?>" class="text-red-500 hover:text-red-700">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </a>
                                        <a href="./news/edit-news.php?id=<?php echo $new['id']; ?>" class="text-blue-500 hover:text-blue-700">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div id="proyectos" class="section">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold">Proyectos</h2>
                    <button onclick="openModalProyectos()" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                        Agregar Proyecto
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="py-3 px-4 text-left">Titulo</th>
                                <th class="py-3 px-4 text-left">Descripción</th>
                                <th class="py-3 px-4 text-left">URL</th>
                                <th class="py-3 px-4 text-left">Imagen</th>
                                <th class="py-3 px-4 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($projects as $project) : ?>
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="py-3 px-4"><?php echo htmlspecialchars($project['title']); ?></td>
                                    <td class="py-3 px-4"><?php echo htmlspecialchars($project['description']); ?></td>
                                    <td class="py-3 px-4"><?php echo htmlspecialchars($project['url']); ?></td>
                                    <td class="py-3 px-4 relative group">
                                        <div class="flex items-center">
                                            <span>
                                                <?php echo htmlspecialchars($project['thumbnail']); ?>
                                            </span>
                                            <!-- Improved hover image preview -->
                                            <div class="hidden opacity-0 scale-95 absolute z-10 top-0 left-[60%] -ml-16 bg-white border border-gray-200 shadow-xl p-2 rounded-lg w-36 h-36 transform transition-all duration-300 ease-in-out group-hover:block group-hover:opacity-100 group-hover:scale-100">
                                                <div class="relative w-full h-full overflow-hidden rounded-md">
                                                    <img src="../uploads/projects/<?php echo htmlspecialchars($project['thumbnail']); ?>"
                                                        alt="Vista previa"
                                                        class="w-full h-full object-cover rounded-md transition-transform duration-300 hover:scale-110">
                                                    <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-60 text-white text-xs py-1 px-2 truncate">
                                                        <?php echo htmlspecialchars($project['thumbnail']); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3 px-4 flex justify-center gap-3">
                                        <a href="./proyects/delete-projects.php?id=<?php echo $project['id']; ?>" class="text-red-500 hover:text-red-700">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </a>
                                        <a href="./proyects/edit-projects.php?id=<?php echo $project['id']; ?>" class="text-blue-500 hover:text-blue-700">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div id="usuarios" class="section">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold">Usuarios</h2>
                    <button onclick="openModalUsuarios()" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                        Agregar Usuario
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="py-3 px-4 text-left">Nombre</th>
                                <th class="py-3 px-4 text-left">Email</th>
                                <th class="py-3 px-4 text-left">Password</th>
                                <th class="py-3 px-4 text-left">Rol</th>
                                <th class="py-3 px-4 text-left">Fecha de registro</th>
                                <th class="py-3 px-4 text-left">Apellidos</th>
                                <th class="py-3 px-4 text-left">Avatar</th>
                                <th class="py-3 px-4 text-left">Edad</th>
                                <th class="py-3 px-4 text-left">Trabajo</th>
                                <th class="py-3 px-4 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user) : ?>
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="py-3 px-4"><?php echo htmlspecialchars($user['name']); ?></td>
                                    <td class="py-3 px-4"><?php echo htmlspecialchars($user['email']); ?></td>
                                    <td class="py-3 px-4"><?php echo htmlspecialchars($user['password']); ?></td>
                                    <td class="py-3 px-4"><?php echo htmlspecialchars($user['rol']); ?></td>
                                    <td class="py-3 px-4"><?php echo htmlspecialchars($user['data_registre']); ?></td>
                                    <td class="py-3 px-4"><?php echo htmlspecialchars($user['surname']); ?></td>
                                    <td class="py-3 px-4 relative group">
                                        <div class="flex items-center">
                                            <span>
                                                <?php echo htmlspecialchars($user['avatar']); ?>
                                            </span>
                                            <!-- Improved hover image preview -->
                                            <div class="hidden opacity-0 scale-95 absolute z-10 top-0 left-[60%] -ml-16 bg-white border border-gray-200 shadow-xl p-2 rounded-lg w-36 h-36 transform transition-all duration-300 ease-in-out group-hover:block group-hover:opacity-100 group-hover:scale-100">
                                                <div class="relative w-full h-full overflow-hidden rounded-md">
                                                    <img src="../uploads/userAvatar/<?php echo htmlspecialchars($user['avatar']); ?>"
                                                        alt="Vista previa"
                                                        class="w-full h-full object-cover rounded-md transition-transform duration-300 hover:scale-110">
                                                    <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-60 text-white text-xs py-1 px-2 truncate">
                                                        <?php echo htmlspecialchars($user['avatar']); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3 px-4"><?php echo htmlspecialchars($user['age']); ?></td>
                                    <td class="py-3 px-4"><?php echo htmlspecialchars($user['job']); ?></td>
                                    <td class="py-3 px-4 flex justify-center gap-3">
                                        <a href="./users/delete-users.php?id=<?php echo $user['id']; ?>" class="text-red-500 hover:text-red-700">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </a>
                                        <a href="./users/edit-users.php?id=<?php echo $user['id']; ?>" class="text-blue-500 hover:text-blue-700">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div id="comentarios" class="section">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold">Comentarios</h2>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="py-3 px-4 text-left">Comentario</th>
                                <th class="py-3 px-4 text-left">Fecha</th>
                                <th class="py-3 px-4 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($comments as $comment) : ?>
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="py-3 px-4"><?php echo htmlspecialchars($comment['comment']); ?></td>
                                    <td class="py-3 px-4"><?php echo htmlspecialchars($comment['date']); ?></td>
                                    <td class="py-3 px-4 flex justify-center gap-3">
                                        <a href="./comments/delete-comments.php?id=<?php echo $comment['id']; ?>" class="text-red-500 hover:text-red-700">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex justify-center items-center z-50">
        <div class="bg-white p-8 rounded-lg w-96 max-w-md mx-auto">
            <h2 class="text-2xl font-bold mb-4">Agregar Testimonio</h2>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre:</label>
                    <input type="text" name="name" id="name" placeholder="Nombre" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-4">
                    <label for="surname" class="block text-sm font-medium text-gray-700 mb-1">Apellidos:</label>
                    <input type="text" name="surname" id="surname" placeholder="Apellidos" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-4">
                    <label for="testimony" class="block text-sm font-medium text-gray-700 mb-1">Testimonio:</label>
                    <textarea name="testimony" id="testimony" placeholder="Testimonio" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 h-24"></textarea>
                </div>
                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Imagen:</label>
                    <input type="file" accept="image/*" name="image" id="image" placeholder="URL" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-4">
                    <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Fecha:</label>
                    <input type="date" name="date" id="date" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="flex justify-between mt-6">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500">
                        Cancelar
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="modalNoticias" class="fixed inset-0 bg-black bg-opacity-50 hidden flex justify-center items-center z-50">
        <div class="bg-white p-8 rounded-lg w-96 max-w-md mx-auto">
            <h2 class="text-2xl font-bold mb-4">Agregar Noticia</h2>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Título:</label>
                    <input type="text" name="title" id="title" placeholder="Título" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-4">
                    <label for="subititle" class="block text-sm font-medium text-gray-700 mb-1">Subtítulo:</label>
                    <input type="text" name="subititle" id="subititle" placeholder="Subtítulo" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-4">
                    <label for="body" class="block text-sm font-medium text-gray-700 mb-1">Imagen:</label>
                    <input type="file" accept="image/*" name="body" id="body" placeholder="URL de la imagen" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-4">
                    <label for="publication_date" class="block text-sm font-medium text-gray-700 mb-1">Fecha de publicación:</label>
                    <input type="date" name="publication_date" id="publication_date" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-4">
                    <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-1">Descripción:</label>
                    <textarea name="descripcion" id="descripcion" placeholder="Descripción" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 h-24"></textarea>
                </div>
                <div class="flex justify-between mt-6">
                    <button type="button" onclick="closeModalNoticias()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500">
                        Cancelar
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div id="modalProyectos" class="fixed inset-0 bg-black bg-opacity-50 hidden flex justify-center items-center z-50">
        <div class="bg-white p-8 rounded-lg w-96 max-w-md mx-auto">
            <h2 class="text-2xl font-bold mb-4">Agregar Proyectos</h2>
            <form action="" method="POST" enctype="multipart/form-data">
                <!-- Form fields for news -->
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Título:</label>
                    <input type="text" name="title" id="title" placeholder="Título" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Descripcion:</label>
                    <input type="text" name="description" id="description" placeholder="Descripcion" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-4">
                    <label for="url" class="block text-sm font-medium text-gray-700 mb-1">URL del proyecto:</label>
                    <input type="text" name="url" id="url" placeholder="URL del proyecto" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-4">
                    <label for="thumbnail" class="block text-sm font-medium text-gray-700 mb-1">Thumbnail:</label>
                    <input type="file" accept="image/*" name="thumbnail" id="thumbnail" placeholder="Imagen" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="flex justify-between mt-6">
                    <button type="button" onclick="closeModalProyectos()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500">
                        Cancelar
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="modalUser" class="fixed inset-0 bg-black bg-opacity-50 hidden flex justify-center items-center z-50">
        <div class="bg-white p-8 rounded-lg w-96 max-w-md mx-auto">
            <h2 class="text-2xl font-bold mb-4">Agregar usuarios</h2>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre:</label>
                    <input type="text" name="name" id="name" placeholder="Nombre" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email:</label>
                    <input type="email" name="email" id="email" placeholder="Email" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Contraseña:</label>
                    <input type="password" name="password" id="password" placeholder="password" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-4">
                    <label for="rol" class="block text-sm font-medium text-gray-700 mb-1">Rol:</label>
                    <select name="rol" id="rol" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="user" selected>User</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="data_register" class="block text-sm font-medium text-gray-700 mb-1">Fecha de registro:</label>
                    <input type="date" name="data_register" id="data_register"
                        value="<?php echo date('Y-m-d'); ?>"
                        class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" readonly>
                </div>

                <div class="mb-4">
                    <label for="surname" class="block text-sm font-medium text-gray-700 mb-1">Apellidos:</label>
                    <input type="text" name="surname" id="surname" placeholder="Apellidos" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-4">
                    <label for="avatar" class="block text-sm font-medium text-gray-700 mb-1">Avatar:</label>
                    <input type="file" accept="image/*" name="avatar" id="avatar" placeholder="URL de la imagen" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="age" class="block text-sm font-medium text-gray-700 mb-1">Edad:</label>
                    <input type="number" name="age" id="age" placeholder="Edad" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="job" class="block text-sm font-medium text-gray-700 mb-1">Trabajo:</label>
                    <input type="text" name="job" id="job" placeholder="Trabajo" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="flex justify-between mt-6">
                    <button type="button" onclick="closeModalUsuarios()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500">
                        Cancelar
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            showSection('testimonios');
        });

        function showSection(sectionId) {
            const sections = document.querySelectorAll('.section');
            sections.forEach(section => {
                section.classList.remove('active');
            });

            document.getElementById(sectionId).classList.add('active');
        }

        function openModal() {
            document.getElementById('modal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('modal').classList.add('hidden');
        }

        function openModalNoticias() {
            document.getElementById('modalNoticias').classList.remove('hidden');
        }

        function closeModalNoticias() {
            document.getElementById('modalNoticias').classList.add('hidden');
        }

        function openModalProyectos() {
            document.getElementById('modalProyectos').classList.remove('hidden');
        }

        function closeModalProyectos() {
            document.getElementById('modalProyectos').classList.add('hidden');

        }

        function openModalUsuarios() {
            document.getElementById('modalUser').classList.remove('hidden');

        }

        function closeModalUsuarios() {
            document.getElementById('modalUser').classList.add('hidden');
        }
    </script>
</body>

</html>