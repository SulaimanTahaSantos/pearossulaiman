<?php

// Llamar al config para la conexión con la BD
session_start();
require_once '../config/config.php';
include_once '../controller/usersController.php';

$uploadDir = __DIR__ . '/uploads/'; 

$avatar = ''; 
$proyecto = '';  

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $age = $_POST['age'];  
    $job = $_POST['job'];  

    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['avatar']['tmp_name'];
        $fileName = $_FILES['avatar']['name'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'svg', 'bmp', 'webp', 'tiff', 'ico', 'JPG', 'JPEG', 'PNG', 'GIF', 'SVG', 'BMP', 'WEBP', 'TIFF', 'ICO'];

        if (in_array($fileExtension, $allowedExtensions)) {
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            $avatarDir = $uploadDir . 'userAvatar/'; 
            
            if (!is_dir($avatarDir)) {
                mkdir($avatarDir, 0777, true); 
            }

            $destPath = $avatarDir . $newFileName;
            
            if (move_uploaded_file($fileTmpPath, $destPath)) {
                $avatar = $newFileName; 
            } else {
                $error_message = 'Hubo un error al subir la imagen del avatar';
            }
        } else {
            $error_message = 'Formato de archivo de avatar no permitido';
        }
    } 
    if (empty($error_message)) {
        $registerUser = createUser($mysqli, $name, $surname, $email, $password, $avatar, $proyecto, $age, $job);
    }
}


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-blue-100 to-indigo-200 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="bg-white rounded-xl shadow-2xl overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-6 text-center">
                <h1 class="text-white text-3xl font-bold">Crear Cuenta</h1>
                <p class="text-blue-100 mt-2">Regístrate para comenzar</p>
            </div>
            
            <div class="p-8">
                <?php if(isset($error_message)): ?>
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded" role="alert">
                        <p><?php echo $error_message; ?></p>
                    </div>
                <?php endif; ?>
                
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">
                            Nombre
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                            <input 
                                type="text" 
                                name="name" 
                                id="name" 
                                class="w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" 
                                placeholder="Tu nombre" 
                                required
                            >
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="surname" class="block text-gray-700 text-sm font-bold mb-2">
                            Apellidos
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                            <input 
                                type="text" 
                                name="surname" 
                                id="surname" 
                                class="w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" 
                                placeholder="Tus apellidos" 
                                required
                            >
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">
                            Email
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                            <input 
                                type="email" 
                                name="email" 
                                id="email" 
                                class="w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" 
                                placeholder="correo@ejemplo.com" 
                                required
                            >
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="password" class="block text-gray-700 text-sm font-bold mb-2">
                            Contraseña
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input 
                                type="password" 
                                name="password" 
                                id="password" 
                                class="w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" 
                                placeholder="••••••••" 
                                required
                            >
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="avatar" class="block text-gray-700 text-sm font-bold mb-2">
                            Foto de perfil
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fas fa-image text-gray-400"></i>
                            </div>
                            <input 
                                type="file" 
                                name="avatar" 
                                id="avatar" 
                                class="w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" 
                                placeholder="URL de tu imagen"
                                accept="image/*"
                                required
                            >
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="age" class="block text-gray-700 text-sm font-bold mb-2">
                            Edad
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fas fa-calendar text-gray-400"></i>
                            </div>
                            <input 
                                type="number" 
                                name="age" 
                                id="age" 
                                class="w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" 
                                placeholder="Tu edad" 
                                required
                            >
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <label for="job" class="block text-gray-700 text-sm font-bold mb-2">
                            Trabajo
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fas fa-briefcase text-gray-400"></i>
                            </div>
                            <input 
                                type="text" 
                                name="job" 
                                id="job" 
                                class="w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" 
                                placeholder="Tu profesión" 
                                required
                            >
                        </div>
                    </div>
                    
                    <button 
                        type="submit" 
                        class="w-full bg-gradient-to-r from-blue-600 to-indigo-700 text-white font-bold py-3 px-4 rounded-lg hover:opacity-90 transition-all transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50"
                    >
                        Registrarse
                    </button>
                </form>
            </div>
            
            <!-- Footer -->
            <div class="bg-gray-50 px-8 py-5 border-t border-gray-100 text-center">
                <p class="text-gray-600 text-sm">
                    ¿Ya tienes una cuenta? 
                    <a href="./login.php" class="text-blue-600 font-medium hover:text-blue-800 transition-colors">
                        Inicia sesión
                    </a>
                </p>
            </div>
        </div>
        
        <div class="mt-8 text-center">
            <p class="text-gray-600 text-sm">
                © 2025 PearOSSulaiman. Todos los derechos reservados.
            </p>
        </div>
    </div>
</body>
</html>
