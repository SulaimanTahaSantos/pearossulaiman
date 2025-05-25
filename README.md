# 🌟 PearOS Sulaiman - Sistema de Gestión de Contenido PHP

> Un sistema completo de gestión de contenido empresarial construido con PHP, MySQL y Bootstrap, con panel de administración avanzado y gestión completa de usuarios.

Para comprobar usuario admin:

Email: sulaiman@gmail.com
password: 12345678

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)

## 📋 Índice

- [Características](#-características)
- [Tecnologías](#-tecnologías)
- [Estructura del Proyecto](#-estructura-del-proyecto)
- [Instalación](#-instalación)
- [Configuración](#-configuración)
- [Uso del Sistema](#-uso-del-sistema)
- [Panel de Administración](#-panel-de-administración)
- [Base de Datos](#-base-de-datos)
- [API y Funcionalidades](#-api-y-funcionalidades)
- [Desarrollo](#-desarrollo)
- [Contribuir](#-contribuir)
- [Licencia](#-licencia)

## ✨ Características

### 🔐 Sistema de Autenticación
- **Registro de usuarios** con validación completa
- **Inicio de sesión** seguro con hash de contraseñas
- **Gestión de sesiones** PHP nativa
- **Control de roles** (Usuario/Administrador)
- **Perfiles de usuario** con información personalizada

### 👥 Gestión de Usuarios
- **CRUD completo** de usuarios
- **Subida de avatares** con validación de formatos
- **Información extendida**: edad, trabajo, apellidos
- **Panel de administración** para gestionar todos los usuarios

### 📰 Sistema de Noticias
- **Creación, edición y eliminación** de noticias
- **Subida de imágenes** para cada noticia
- **Fechas de publicación** automáticas
- **Vista previa** en hover de imágenes en el panel admin

### 💼 Gestión de Proyectos
- **Portfolio dinámico** de proyectos
- **Imágenes thumbnail** para cada proyecto
- **URLs externas** para enlaces a proyectos
- **Descripciones detalladas**

### 💬 Sistema de Comentarios
- **Comentarios** vinculados a noticias
- **Asociación** con usuarios registrados
- **Gestión completa** desde el panel de administración

### 🗣️ Testimonios
- **Gestión de testimonios** de clientes
- **Imágenes personalizadas** para cada testimonio
- **Fechas de publicación**

### 🎨 Interfaz Moderna
- **Bootstrap 5** responsive design
- **Tailwind CSS** para el panel de administración
- **Font Awesome** iconografía
- **Interfaz intuitiva** y moderna

## 🛠️ Tecnologías

### Backend
- **PHP 7.4+** - Lenguaje principal
- **MySQL** - Base de datos relacional
- **MySQLi** - Extensión de base de datos

### Frontend
- **HTML5 & CSS3** - Estructura y estilos
- **Bootstrap 5** - Framework CSS responsive
- **Tailwind CSS** - Utility-first CSS framework
- **JavaScript** - Interactividad
- **Font Awesome** - Iconografía

### Herramientas de Desarrollo
- **Gulp** - Automatización de tareas
- **Sass/SCSS** - Preprocesador CSS
- **Browser Sync** - Recarga automática en desarrollo
- **Autoprefixer** - Prefijos CSS automáticos

## 📁 Estructura del Proyecto

```
projectUF3CRUDPHP/
├── 📁 config/
│   └── config.php              # Configuración de base de datos
├── 📁 controller/
│   ├── adminController.php     # Lógica del panel de administración
│   ├── commentsController.php  # Gestión de comentarios
│   ├── newsController.php      # Gestión de noticias
│   ├── ProjectController.php   # Gestión de proyectos
│   ├── testimonyController.php # Gestión de testimonios
│   └── usersController.php     # Gestión de usuarios
├── 📁 source/                  # Archivos fuente para desarrollo
│   ├── *.php                   # Páginas principales
│   ├── 📁 images/              # Imágenes estáticas
│   ├── 📁 js/                  # JavaScript
│   ├── 📁 scss/                # Estilos Sass
│   └── 📁 plugins/             # Librerías de terceros
├── 📁 theme/                   # Tema compilado (producción)
│   ├── *.php                   # Páginas del sitio web
│   ├── 📁 admin/               # Panel de administración
│   │   ├── adminPanel.php      # Dashboard principal
│   │   ├── 📁 comments/        # Gestión de comentarios
│   │   ├── 📁 news/            # Gestión de noticias
│   │   ├── 📁 proyects/        # Gestión de proyectos
│   │   ├── 📁 testimonials/    # Gestión de testimonios
│   │   └── 📁 users/           # Gestión de usuarios
│   ├── 📁 css/                 # Estilos compilados
│   ├── 📁 js/                  # JavaScript compilado
│   ├── 📁 plugins/             # Librerías compiladas
│   └── 📁 uploads/             # Archivos subidos por usuarios
│       ├── 📁 avatars/         # Avatares de usuarios
│       ├── 📁 news/            # Imágenes de noticias
│       ├── 📁 projects/        # Imágenes de proyectos
│       └── 📁 testimonio/      # Imágenes de testimonios
├── package.json                # Dependencias Node.js
├── gulpfile.js                 # Configuración de Gulp
└── README.md                   # Documentación del proyecto
```

## 🚀 Instalación

### Prerrequisitos

- **PHP 7.4 o superior** con las extensiones:
  - `mysqli`
  - `fileinfo`
  - `gd` (para manipulación de imágenes)
- **MySQL 5.7 o superior**
- **Servidor web** (Apache/Nginx) o XAMPP/WAMP para desarrollo
- **Node.js 14+** (para herramientas de desarrollo)
- **Composer** (opcional, para dependencias PHP futuras)

### Instalación Básica

1. **Clonar el repositorio:**
```bash
git clone https://github.com/tu-usuario/projectUF3CRUDPHP.git
cd projectUF3CRUDPHP
```

2. **Configurar la base de datos:**
```sql
CREATE DATABASE sulaiman_crud_uf3;
USE sulaiman_crud_uf3;

-- Ejecutar el script SQL para crear las tablas (ver sección Base de Datos)
```

3. **Configurar la conexión:**
```php
// config/config.php
$host = 'tu_host_mysql';  
$db = 'sulaiman_crud_uf3';  
$user = 'tu_usuario'; 
$password = 'tu_contraseña';
```

4. **Configurar permisos:**
```bash
chmod 755 theme/uploads/
chmod 755 theme/uploads/avatars/
chmod 755 theme/uploads/news/
chmod 755 theme/uploads/projects/
chmod 755 theme/uploads/testimonio/
```

### Instalación para Desarrollo

1. **Instalar dependencias de Node.js:**
```bash
npm install
```

2. **Ejecutar el entorno de desarrollo:**
```bash
npm run dev
```

3. **Construir para producción:**
```bash
npm run build
```

## ⚙️ Configuración

### Base de Datos

El archivo `config/config.php` contiene la configuración de conexión:

```php
<?php
$host = 'mysql-sulaiman.alwaysdata.net';  
$db = 'sulaiman_crud_uf3';  
$user = 'sulaiman_'; 
$password = 'APTItude01';

$mysqli = new mysqli($host, $user, $password, $db);

if ($mysqli->connect_error) {
    die("Conexión fallida: " . $mysqli->connect_error);
}
?>
```

### Estructura de Carpetas de Uploads

```
theme/uploads/
├── avatars/        # Avatares de usuarios (JPG, PNG, GIF, SVG)
├── news/           # Imágenes de noticias
├── projects/       # Imágenes de proyectos
├── testimonio/     # Imágenes de testimonios
└── userAvatar/     # Avatares adicionales
```

## 🎯 Uso del Sistema

### Registro e Inicio de Sesión

1. **Registro de nuevo usuario:**
   - Navegar a `/theme/register.php`
   - Completar el formulario con todos los campos requeridos
   - Subir avatar (opcional)
   - El sistema hasheará automáticamente la contraseña

2. **Inicio de sesión:**
   - Navegar a `/theme/login.php`
   - Introducir email y contraseña
   - El sistema creará una sesión automáticamente

### Navegación del Sitio

- **Página principal:** `/theme/index.php` - Muestra proyectos y noticias
- **Blog:** `/theme/blog.php` - Lista de noticias
- **Servicios:** `/theme/services.php` - Servicios ofrecidos
- **Contacto:** `/theme/contact.php` - Formulario de contacto
- **Equipo:** `/theme/team.php` - Información del equipo

## 🔧 Panel de Administración

Accesible desde `/theme/admin/adminPanel.php` (solo para usuarios con rol 'admin')

### Funcionalidades del Dashboard

#### 📊 Estadísticas Generales
- Contador de testimonios
- Contador de noticias  
- Contador de proyectos
- Contador de usuarios
- Contador de comentarios

#### 👥 Gestión de Usuarios
- **Ver todos los usuarios** con información completa
- **Agregar nuevos usuarios** con formulario modal
- **Editar usuarios existentes** (`/admin/users/edit-users.php`)
- **Eliminar usuarios** (`/admin/users/delete-users.php`)
- **Vista previa de avatares** en hover

#### 📰 Gestión de Noticias
- **CRUD completo** de noticias
- **Subida de imágenes** con validación
- **Vista previa** de imágenes en el listado
- **Formularios modales** para agregar/editar

#### 💼 Gestión de Proyectos
- **Portfolio management** completo
- **Imágenes thumbnail** para cada proyecto
- **Enlaces externos** configurables
- **Edición inline** de proyectos

#### 💬 Gestión de Comentarios
- **Moderación** de comentarios
- **Asociación** con usuarios y noticias
- **Eliminación** y edición de comentarios

#### 🗣️ Gestión de Testimonios
- **CRUD de testimonios** de clientes
- **Imágenes personalizadas**
- **Fechas de publicación** automáticas

### Características del Panel Admin

- **Interfaz Tailwind CSS** moderna y responsive
- **Modales dinámicos** para formularios
- **Vista previa de imágenes** en hover
- **Iconografía SVG** consistente
- **Navegación por pestañas** entre secciones
- **Formularios con validación** del lado cliente y servidor

## 🗄️ Base de Datos

### Tablas Principales

#### `users`
```sql
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    surname VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    rol ENUM('user', 'admin') DEFAULT 'user',
    data_registre DATE NOT NULL,
    avatar VARCHAR(255),
    age INT,
    job VARCHAR(100)
);
```

#### `news`
```sql
CREATE TABLE news (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(200) NOT NULL,
    subititle VARCHAR(300),
    body TEXT,
    publication_date DATE NOT NULL,
    descripcion TEXT
);
```

#### `projects`
```sql
CREATE TABLE projects (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(200) NOT NULL,
    description TEXT,
    url VARCHAR(500),
    thumbnail VARCHAR(255)
);
```

#### `testimony`
```sql
CREATE TABLE testimony (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    surname VARCHAR(100) NOT NULL,
    testimony TEXT NOT NULL,
    image VARCHAR(255),
    date DATE NOT NULL
);
```

#### `comentarios`
```sql
CREATE TABLE comentarios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_news_id INT,
    id_user_id INT,
    comment TEXT NOT NULL,
    date DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_news_id) REFERENCES news(id),
    FOREIGN KEY (id_user_id) REFERENCES users(id)
);
```

## 🔌 API y Funcionalidades

### Controladores Principales

#### `adminController.php`
- `readTestimonios()` - Obtener todos los testimonios
- `addTestimonial()` - Agregar nuevo testimonio
- `deleteTestimonial()` - Eliminar testimonio
- `editTestimonial()` - Editar testimonio existente
- `readNews()` - Obtener todas las noticias
- `addNews()` - Agregar nueva noticia
- `deleteNews()` - Eliminar noticia
- `editNews()` - Editar noticia
- `readProjects()` - Obtener todos los proyectos
- `addProject()` - Agregar nuevo proyecto
- `deleteProject()` - Eliminar proyecto
- `editProject()` - Editar proyecto
- `readUsers()` - Obtener todos los usuarios
- `addUsers()` - Agregar nuevo usuario
- `deleteUsers()` - Eliminar usuario
- `editUsers()` - Editar usuario
- `readComments()` - Obtener todos los comentarios
- `deleteComments()` - Eliminar comentario
- `editComments()` - Editar comentario

#### `usersController.php`
- `readUsers($mysqli, $email)` - Buscar usuario por email
- `createUser()` - Registrar nuevo usuario con hash de contraseña

#### `commentsController.php`
- `readComments($mysqli, $id_news)` - Obtener comentarios de una noticia
- `insertComment()` - Insertar nuevo comentario

### Características de Seguridad

- **Contraseñas hasheadas** con `password_hash()` y `password_verify()`
- **Consultas preparadas** para prevenir SQL injection
- **Validación de archivos** subidos (tipos permitidos, tamaño)
- **Control de sesiones** PHP nativo
- **Verificación de roles** para acceso al panel admin
- **Sanitización** de datos de entrada con `htmlspecialchars()`

### Gestión de Archivos

- **Subida de imágenes** con validación de formato
- **Renombrado automático** con MD5 hash para evitar conflictos
- **Organización por carpetas** según tipo de contenido
- **Formatos soportados:** JPG, PNG, JPEG, GIF, SVG, WEBP, AVIF, BMP, ICO, TIFF

## 🔨 Desarrollo

### Scripts Disponibles

```json
{
  "scripts": {
    "dev": "gulp",           // Desarrollo con watch y browser-sync
    "build": "gulp build"    // Construcción para producción
  }
}
```

### Tareas de Gulp

- **Compilación SCSS** a CSS con autoprefixer
- **Concatenación** y minificación de archivos
- **Browser Sync** para recarga automática
- **Source maps** para desarrollo
- **File include** para modularidad HTML
- **Optimización** de imágenes

### Estructura de Desarrollo

```
source/                     # Archivos fuente
├── scss/                  # Estilos Sass
│   ├── _variables.scss    # Variables globales
│   ├── _mixins.scss       # Mixins reutilizables
│   ├── _common.scss       # Estilos comunes
│   ├── _typography.scss   # Tipografía
│   ├── _buttons.scss      # Botones
│   └── style.scss         # Archivo principal
├── js/                    # JavaScript
├── images/                # Imágenes estáticas
└── plugins/               # Librerías de terceros
```

### Compilación

El proceso de compilación genera:
- CSS optimizado y minificado
- JavaScript concatenado
- Imágenes optimizadas
- Archivos PHP procesados con includes

## 🤝 Contribuir

### Cómo Contribuir

1. **Fork** el proyecto
2. **Crear una rama** para tu feature (`git checkout -b feature/AmazingFeature`)
3. **Commit** tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. **Push** a la rama (`git push origin feature/AmazingFeature`)
5. **Abrir un Pull Request**

### Estándares de Código

- **PHP:** Seguir PSR-4 y PSR-12
- **JavaScript:** ES6+ con funciones arrow y const/let
- **CSS:** Metodología BEM para naming
- **Comentarios:** En español para funciones principales

### Reporte de Bugs

Para reportar bugs, incluir:
- Descripción detallada del problema
- Pasos para reproducir
- Versión de PHP y MySQL
- Screenshots si es aplicable

## 📄 Licencia

Este proyecto está bajo la Licencia MIT. Ver el archivo `LICENSE` para más detalles.

### Créditos

- **Template Base:** Agen Bootstrap Template por [Themefisher](https://themefisher.com)
- **Desarrollo:** Sulaiman El Taha
- **Frameworks:** Bootstrap, Tailwind CSS, PHP, MySQL

---

### 📞 Contacto

**Desarrollador:** Sulaiman El Taha Santos  
**Email:** sulat3821@gmail.conm  
**Proyecto:** PearOS Sulaiman CMS  

---

**⭐ Si este proyecto te ha sido útil, considera darle una estrella en GitHub!**
