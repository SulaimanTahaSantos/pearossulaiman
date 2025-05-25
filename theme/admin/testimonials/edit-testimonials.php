<?php
session_start();
require_once '../../../config/config.php';
include_once '../../../controller/adminController.php';

// 1. Verificar que el rol sea administrador
if ($_SESSION['user_rol'] !== 'admin') {
    echo 'No tienes permisos para acceder a esta página';
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $mysqli->prepare("SELECT * FROM testimony WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $testimonio = $result->fetch_assoc();

    if (!$testimonio) {
        echo 'Testimonio no encontrado';
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['id'], $_POST['name'], $_POST['surname'], $_POST['testimony'], $_FILES['image'], $_POST['date'])) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $testimony = $_POST['testimony'];
            $image = '';  // Inicializamos como vacío
            $date = $_POST['date'];

            $uploadDir = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR;

            // Verificar si se subió una imagen
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['image']['tmp_name'];
                $fileName = $_FILES['image']['name'];
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));
                $allowedExtensions = [
                    'jpg',
                    'png',
                    'jpeg',
                    'gif',
                    'svg',
                    'webp',
                    'avif',
                    'bmp',
                    'ico',
                    'tiff',
                    'tif',
                    'jfif',
                    'pjpeg',
                    'pjp',
                    'JPG',
                    'PNG',
                    'JPEG',
                    'GIF',
                    'SVG',
                    'WEBP',
                    'AVIF',
                    'BMP',
                    'ICO',
                    'TIFF',
                    'TIF',
                    'JFIF',
                    'PJPEG',
                    'PJP'
                ];
                if (in_array($fileExtension, $allowedExtensions)) {
                    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
                    $testimonioDir = $uploadDir . 'testimonio' . DIRECTORY_SEPARATOR;

                    if (!is_dir($testimonioDir)) {
                        mkdir($testimonioDir, 0777, true);
                    }

                    $destPath = $testimonioDir . $newFileName;

                    if (move_uploaded_file($fileTmpPath, $destPath)) {
                        $image = $newFileName;  // Solo asignamos el nombre de la imagen
                    } else {
                        $error_message = 'Hubo un error al subir la imagen del testimonio';
                    }
                } else {
                    $error_message = 'Formato de archivo no permitido. Solo se permiten imágenes JPG, PNG, JPEG, GIF o SVG';
                }
            } else {
                // Si no se sube una nueva imagen, mantenemos la imagen existente
                $image = $testimonio['image'];
            }

            // Si no hubo error, procedemos a editar el testimonio
            if (empty($error_message)) {
                editTestimonial($mysqli, $id, $name, $surname, $testimony, $image, $date);
            } else {
                echo $error_message;
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <a href="../../"></a>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Testimonio</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 py-6 flex justify-center items-center">

    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg">
        <h2 class="text-2xl font-semibold text-center mb-6">Editar Testimonio</h2>

        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                <input type="text" id="name" name="name" value="<?php echo $testimonio['name']; ?>" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="surname" class="block text-sm font-medium text-gray-700">Apellido</label>
                <input type="text" id="surname" name="surname" value="<?php echo $testimonio['surname']; ?>" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="testimony" class="block text-sm font-medium text-gray-700">Testimonio</label>
                <textarea id="testimony" name="testimony" rows="4" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required><?php echo $testimonio['testimony']; ?></textarea>
            </div>

            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700">Imagen</label>
                <input type="file" accept="image/*" id="image" name="image" value="<?php echo $testimonio['image']; ?>" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="date" class="block text-sm font-medium text-gray-700">Fecha</label>
                <input type="date" id="date" name="date" value="<?php echo $testimonio['date']; ?>" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div class="flex justify-between items-center">
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Actualizar</button>
                <a href="../adminPanel.php" class="text-blue-500 hover:text-blue-700">Cancelar</a>
            </div>
        </form>
    </div>

</body>

</html>