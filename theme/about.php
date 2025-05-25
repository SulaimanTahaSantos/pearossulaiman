<?php
include_once '../config/config.php';
include_once '../controller/testimonyController.php';

$testimonys = readTestimony($mysqli);
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
        </nav>
    </header>

    <!-- page-title -->
    <section class="page-title bg-cover" data-background="https://lasombradelhelicoptero.wordpress.com/wp-content/uploads/2011/12/1b936-pearos1.png">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="display-1 text-white font-weight-bold font-primary">About PearOS Sulaiman</h1>
                </div>
            </div>
        </div>
    </section>
    

    <!-- testimonial-slider -->
    <section class="section bg-secondary">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2 class="text-white mb-5">Testimonios</h2>
                </div>
            </div>
            <div class="row bg-contain" data-background="images/banner/brush.png">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div id="slider" class="ui-card-slider bg-contain">
                        <?php
                          while ($testimony = $testimonys->fetch_assoc()) { ?>
                        <div class="slide">
                            <div class="card text-center">
                                <div class="card-body px-5 py-4">
                                    <img width="50px" src="./uploads/testimonio/<?php echo htmlspecialchars($testimony['image']); ?>"
                                        alt="user-1" class="img-fluid rounded-circle mb-4">
                                    <h4 class="text-secondary"><?php
                                        echo $testimony['name'] . " " . $testimony['surname'];
                                    ?></h4>
                                    <p><?php
                                        echo $testimony['testimony'];
                                    ?></p>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /testimonial-slider -->

   

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
                        <p class="text-light mb-0">Pear OS Sulaiman &copy; 2025. All Rights Reserved. 
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