<?php
session_start();
require_once '../config/config.php';
include_once '../controller/usersController.php';

// 1.Comprobar si el formulario a sido enviado
if($_SERVER['REQUEST_METHOD'] === 'POST'){
   // 2.Guardar los datos del formulario en variables
    $email = $_POST['email'];
    $password = $_POST['password'];

    // 3. Ejecutar la consulta
    $users = readUsers($mysqli, $email);

    // 4. Comprobar si hay usersados
    if($users && $users->num_rows > 0){
        $user = $users->fetch_assoc();
        // 5. Comprobar si la contraseña es correcta
        if(password_verify($password, $user['password'])){
            // 6. Guardar el usuario en la sesion
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_surname'] = $user['surname'];
            $_SESSION['user_avatar'] = $user['avatar'];
            $_SESSION['user_rol'] = $user['rol'];
            $_SESSION['user_age'] = $user['age'];
            $_SESSION['user_job'] = $user['job'];
            header('Location: index.php');
            exit;
        }
    }
    $error_message = 'Usuario o contraseña incorrectos';
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-blue-100 to-indigo-200 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="bg-white rounded-xl shadow-2xl overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-6 text-center">
                <h1 class="text-white text-3xl font-bold">Bienvenido</h1>
                <p class="text-blue-100 mt-2">Inicia sesión para continuar</p>
            </div>
            
            <div class="p-8">
                <?php if(isset($error_message)): ?>
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded" role="alert">
                        <p><?php echo $error_message; ?></p>
                    </div>
                <?php endif; ?>
                
                <form action="" method="post">
                    <div class="mb-6">
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
                    
                    <div class="mb-6">
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
                    
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <input type="checkbox" id="remember" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="remember" class="ml-2 block text-sm text-gray-700">
                                Recordarme
                            </label>
                        </div>
                        <a href="#" class="text-sm text-blue-600 hover:text-blue-800 transition-colors">
                            ¿Olvidaste tu contraseña?
                        </a>
                    </div>
                    
                    <button 
                        type="submit" 
                        class="w-full bg-gradient-to-r from-blue-600 to-indigo-700 text-white font-bold py-3 px-4 rounded-lg hover:opacity-90 transition-all transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50"
                    >
                        Iniciar Sesión
                    </button>
                </form>
            </div>
            
            <!-- Footer -->
            <div class="bg-gray-50 px-8 py-5 border-t border-gray-100 text-center">
                <p class="text-gray-600 text-sm">
                    ¿No tienes una cuenta? 
                    <a href="./register.php" class="text-blue-600 font-medium hover:text-blue-800 transition-colors">
                        Regístrate ahora
                    </a>
                </p>
            </div>
        </div>
        
        <!-- Brand Logo or Text -->
        <div class="mt-8 text-center">
            <p class="text-gray-600 text-sm">
                © 2025 PearOSSulaiman. Todos los derechos reservados.
            </p>
        </div>
    </div>
</body>
</html>