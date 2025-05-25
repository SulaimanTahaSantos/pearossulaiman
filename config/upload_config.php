<?php
// Configuración de directorios para Railway
function getUploadDir() {
    // En Railway, usar directorio temporal para uploads
    $baseDir = $_ENV['RAILWAY_VOLUME_MOUNT_PATH'] ?? sys_get_temp_dir();
    $uploadDir = $baseDir . '/uploads/';
    
    // Crear directorios si no existen
    $subdirs = ['testimonio', 'news', 'projects', 'avatars', 'userAvatar'];
    foreach ($subdirs as $subdir) {
        $path = $uploadDir . $subdir;
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
    }
    
    return $uploadDir;
}

function getUploadPath($subfolder = '') {
    $uploadDir = getUploadDir();
    return $subfolder ? $uploadDir . $subfolder . '/' : $uploadDir;
}
?>
