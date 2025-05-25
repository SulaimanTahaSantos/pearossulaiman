<?php
session_start();
include_once "../config/config.php"; 
include_once "../controller/newsController.php";


// Vamos a hacer que redirija el usuario si el usuario no está logueado
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

function readProject($mysqli) {
    $sql = "SELECT * FROM projects";
    $result = $mysqli->query($sql);
    
    if (!$result) {
        echo "Error en la consulta: " . $mysqli->error;
        return false; // Devuelve false si hay error
    }
    
    return $result;
}

$news = readNews($mysqli);


?>


<!DOCTYPE html>

<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://www.facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->

<html lang="zxx">

<head>
    <meta charset="utf-8">
    <title>PearOS Sulaiman</title>

    <!-- mobile responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- theme meta -->
    <meta name="theme-name" content="agen" />

    <!-- ** Plugins Needed for the Project ** -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="plugins/bootstrap/bootstrap.min.css">
    <!-- slick slider -->
    <link rel="stylesheet" href="plugins/slick/slick.css">
    <!-- themefy-icon -->
    <link rel="stylesheet" href="plugins/themify-icons/themify-icons.css">
    <!-- venobox css -->
    <link rel="stylesheet" href="plugins/venobox/venobox.css">
    <!-- card slider -->
    <link rel="stylesheet" href="plugins/card-slider/css/style.css">

    <!-- Main Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <!--Favicon-->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    
 <style>
    .elipsis {
    display: -webkit-box;               
    -webkit-box-orient: vertical;      
    overflow: hidden;                  
    -webkit-line-clamp: 2;              
    line-height: 1.5;                   
    max-height: 4.5em;                  
  }

  .projects-section {
    background-color: #f8f9fa;
}

.section-title {
    font-weight: 700;
    color: #333;
}

.title-underline {
    height: 3px;
    width: 70px;
    background-color: #007bff;
    margin: 0 auto;
    margin-bottom: 20px;
}

.project-card {
    transition: all 0.3s ease;
    overflow: hidden;
    border-radius: 8px;
}

.project-card:hover {
    transform: translateY(-5px);
}

.project-img-container {
    position: relative;
    overflow: hidden;
}

.project-img {
    height: 220px;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.project-card:hover .project-img {
    transform: scale(1.05);
}

.project-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 123, 255, 0.8);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: all 0.3s ease;
}

.project-card:hover .project-overlay {
    opacity: 1;
}

.project-buttons {
    text-align: center;
}

.project-buttons .btn {
    margin: 0 5px;
}

.card-body {
    padding: 1.5rem;
}

.card-title {
    font-weight: 600;
    margin-bottom: 0.5rem;
}
  </style>
</head>

<body>
    <header class="navigation fixed-top">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <a class="navbar-brand" href="index.php"><img width="40px" src="images/pearos.png" alt="Egen"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
                aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse text-center" id="navigation">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="blog.php">Blog</a>
                    </li>
                </ul>
            </div>
            <?php if(isset($_SESSION['user_id'])): ?>
                <div class="flex items-center space-x-2">
                    <a href="./uploads/userAvatar/"></a>
                    <img width="42px" height="42px" src="<?= './uploads/userAvatar/' . $_SESSION['user_avatar'] ?>" alt="Avatar" class="w-10 h-10 rounded-full border-2 border-white">
                    <span class="text-white hover:text-gray-300"><?= $_SESSION['user_name'] ?></span>
                    <?php
                        if($_SESSION['user_rol'] === 'admin'){
                            echo '<a href="./admin/adminPanel.php" class="text-blue-400 hover:text-blue-600">
<svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
  <path stroke="currentColor" stroke-linecap="square" stroke-linejoin="round" stroke-width="2" d="M10 19H5a1 1 0 0 1-1-1v-1a3 3 0 0 1 3-3h2m10 1a3 3 0 0 1-3 3m3-3a3 3 0 0 0-3-3m3 3h1m-4 3a3 3 0 0 1-3-3m3 3v1m-3-4a3 3 0 0 1 3-3m-3 3h-1m4-3v-1m-2.121 1.879-.707-.707m5.656 5.656-.707-.707m-4.242 0-.707.707m5.656-5.656-.707.707M12 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
</svg>


</a>

';
                        }
                    ?>
                </div>
            <?php endif; ?>
            <a href="./admin/adminPanel.php"></a>
            <ul class="flex space-x-4">
                <?php if(!isset($_SESSION['user_id'])): ?>
                    <li><a href="login.php" class="text-white hover:text-gray-300">Iniciar sesión</a></li>
                    <li><a href="register.php" class="text-white hover:text-gray-300">Registrarse</a></li>
                <?php else: ?>
                    <li><a href="logout.php" class="text-white hover:text-gray-300">Cerrar sesión</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

<section class="banner bg-cover position-relative d-flex justify-content-center align-items-center"
  data-background="https://lasombradelhelicoptero.wordpress.com/wp-content/uploads/2011/12/1b936-pearos1.png">
  <div class="container">
    <div class="row">
      <div class="col-12 text-center">
        <h1 class="display-1 text-white font-weight-bold font-primary">PearOS Sulaiman</h1>
      </div>
    </div>
  </div>
</section>

    <!-- about -->
    <section class="section-lg position-relative bg-cover" data-background="images/backgrounds/about-bg.jpg">
        <img src="images/backgrounds/about-bg-overlay.png" alt="overlay" class="overlay-image img-fluid">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-6 col-md-8 col-sm-7 col-8">
                    <h2 class="text-white mb-4">Quienes somos</h2>
                    <p class="text-light mb-4">En Pear OS, creemos en la simplicidad, la elegancia y la eficiencia. Somos una empresa dedicada a desarrollar un sistema operativo basado en Linux que combina un diseño atractivo con un rendimiento optimizado. Nuestra misión es ofrecer una experiencia fluida, intuitiva y moderna para usuarios de todos los niveles.

Inspirados en la innovación y la accesibilidad, trabajamos constantemente para mejorar Pear OS, brindando una alternativa sólida, segura y estética en el mundo de los sistemas operativos. Si buscas un entorno ágil, estable y con una interfaz hermosa, estás en el lugar adecuado.

Descubre un sistema operativo diferente. Descubre Pear OS. </p>
                    <a href="about.php" class="btn btn-primary">Read More</a>
                </div>
            </div>
        </div>
    </section>
    <!-- /about -->

    <!-- project -->
  <section class="projects-section py-5">
    <div class="container">
        <!-- Section Header -->
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="section-title position-relative mb-3">Proyectos</h2>
                <div class="title-underline"></div>
                <p class="text-muted">Descubre nuestros trabajos más destacados</p>
            </div>
        </div>
        
        <!-- Projects Grid -->
        <div class="row g-4">
            
            <?php 
            $projects = readProject($mysqli);
            while ($project = $projects->fetch_assoc()) { ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card project-card h-100 border-0 shadow-sm">
                    <div class="project-img-container">
                        <img src="./uploads/projects/<?php echo htmlspecialchars($project['thumbnail']); ?>" alt="<?php echo htmlspecialchars($project['title']); ?>" 
                            class="card-img-top project-img">
                        <div class="project-overlay">
                            <div class="project-buttons">
                                <a href="<?php echo htmlspecialchars($project['url']); ?>" class="btn btn-light btn-sm">
                                    <i class="fas fa-eye me-1"></i> Ver proyecto
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($project['title']); ?></h5>
                        <?php if(isset($project['description'])) { ?>
                        <p class="card-text text-muted"><?php echo htmlspecialchars($project['description']); ?></p>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>
    <!-- /project -->


    <!-- blog -->
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto text-center">
                    <h2>Latest News</h2>
                    <div class="section-border"></div>
                </div>
            </div>
            <div class="row">
                <?php
                while ($new = $news->fetch_assoc()) {?>
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <article class="card">
                        <img src="./uploads/news/<?php echo htmlspecialchars($new['body']); ?>" alt="post-thumb"
                            class="card-img-top mb-2">
                        <div class="card-body p-0">
                            <time><?php
                            echo htmlspecialchars($new['publication_date'])
                            ?></time>
                            <p class="elipsis">
                                <?php
                                echo htmlspecialchars($new['descripcion']);
                                ?>
                            </p>
                        <a href="blog-single.php?id=<?php echo $new['id']; ?>" class="h4 card-title d-block my-3 text-dark hover-text-underline"><?php echo htmlspecialchars($new['title']); ?></a>

                          
                            </a>
                            <a href="#" class="btn btn-transparent">Read more</a>
                        </div>
                    </article>
                </div>

                <?php } ?>
            </div>
        </div>
    </section>
    <!-- /blog -->

    <!-- footer -->
    <footer class="bg-secondary position-relative">
        <img src="images/backgrounds/map.png" class="img-fluid overlay-image" alt="">
        <div class="section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-3 col-6">
                        <h4 class="text-white mb-5">About</h4>
                        <ul class="list-unstyled">
                            <li><a href="#" class="text-light d-block mb-3">Service</a></li>
                            <li><a href="#" class="text-light d-block mb-3">Conatact</a></li>
                            <li><a href="#" class="text-light d-block mb-3">About us</a></li>
                            <li><a href="#" class="text-light d-block mb-3">Blog</a></li>
                            <li><a href="#" class="text-light d-block mb-3">Support</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-6">
                        <h4 class="text-white mb-5">Company</h4>
                        <ul class="list-unstyled">
                            <li><a href="#" class="text-light d-block mb-3">Service</a></li>
                            <li><a href="#" class="text-light d-block mb-3">Conatact</a></li>
                            <li><a href="#" class="text-light d-block mb-3">About us</a></li>
                            <li><a href="#" class="text-light d-block mb-3">Blog</a></li>
                            <li><a href="#" class="text-light d-block mb-3">Support</a></li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <div class="bg-white p-4">
                            <h3>Contact us</h3>
                            <form action="#">
                                <input type="text" id="name" name="name" class="form-control mb-4 px-0"
                                    placeholder="Full name">
                                <input type="text" id="name" name="name" class="form-control mb-4 px-0"
                                    placeholder="Email address">
                                <textarea name="message" id="message" class="form-control mb-4 px-0"
                                    placeholder="Message"></textarea>
                                <button class="btn btn-primary" type="submit">Send</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pb-4">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-md-left">
                        <p class="text-light mb-0">2025 PearOs Sulaiman
                        </p>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-inline text-md-right text-center">
                            <li class="list-inline-item"><a class="d-block p-3 text-white" href="https://github.com/SulaimanTahaSantos?tab=repositories"><i
                                        class="ti-github"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- /footer -->

    <!-- jQuery -->
    <script src="plugins/jQuery/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="plugins/bootstrap/bootstrap.min.js"></script>
    <!-- slick slider -->
    <script src="plugins/slick/slick.min.js"></script>
    <!-- venobox -->
    <script src="plugins/venobox/venobox.min.js"></script>
    <!-- shuffle -->
    <script src="plugins/shuffle/shuffle.min.js"></script>
    <!-- apear js -->
    <script src="plugins/counto/apear.js"></script>
    <!-- counter -->
    <script src="plugins/counto/counTo.js"></script>
    <!-- card slider -->
    <script src="plugins/card-slider/js/card-slider-min.js"></script>
    <!-- google map -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU&libraries=places">
    </script>
    <script src="plugins/google-map/gmap.js"></script>

    <!-- Main Script -->
    <script src="js/script.js"></script>

</body>

</html>