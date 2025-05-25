<?php
  include_once '../config/config.php';
  include_once '../controller/commentsController.php';
  include_once '../controller/newsController.php';
 if(isset($_GET['id'])){
     $id = $_GET['id'];
     $sql = "SELECT * FROM news WHERE id = $id";
     $result = $mysqli->query($sql);
     $new = $result->fetch_assoc();
 }

 $comments = readComments($mysqli, $id);

$comments = $comments->fetch_all(MYSQLI_ASSOC);

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
  <title>Agen | Bootstrap Agency Template</title>

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
  <style>
    .elipsis {
    display: -webkit-box;               
    -webkit-box-orient: vertical;      
    overflow: hidden;                  
    -webkit-line-clamp: 2;              
    line-height: 1.5;                   
    max-height: 4.5em;                  
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
  </nav>
</header>

<!-- page-title -->
<section class="page-title bg-cover" data-background="https://lasombradelhelicoptero.wordpress.com/wp-content/uploads/2011/12/1b936-pearos1.png">
  <div class="container">
    <div class="row">
      <div class="col-12 text-center">
        <h1 class="display-1 text-white font-weight-bold font-primary">Detalles de la noticia</h1>
      </div>
    </div>
  </div>
</section>
<!-- /page-title -->

<section class="section">
  <div class="container">
    <div class="row">
      <div class="col-lg-10 mx-auto">
        <h3 class="font-tertiary mb-5"><?php
        echo $new['title'];
        ?></h3>
        <img src="./uploads/news/<?php echo htmlspecialchars($new['body']); ?>" alt="post-thumb" class="img-fluid w-100 mb-3">
        <p><?php
        echo $new['publication_date'];
        ?></p>
        <div class="content">
          <p>
          <?php
        echo $new['descripcion'];
        ?>
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

<section>
  <div class="container">
    <div class="row">
      <div class="col-lg-10 mx-auto">
        <div class="p-5 mb-4">
         <?php foreach ($comments as $comment): ?>
  <div class="media border-bottom py-4">
    <img width="93px" height="93px" src="./uploads/userAvatar/<?php echo htmlspecialchars($comment['avatar']); ?>" class="img-fluid align-self-start mr-3" alt="">
    <div class="media-body">
      <h5 class="mb-0 text-secondary">
        <?php echo htmlspecialchars($comment['name']); ?>
      </h5>
      <span class="mr-3">
        <?php echo htmlspecialchars($comment['date']); ?>
      </span>
      <a href="#" class="btn btn-transparent py-1 px-2">
        <i class="ti-share-alt"></i> Reply
      </a>
      <p>
        <?php echo htmlspecialchars($comment['comment']); ?>
      </p>
    </div>
  </div>
<?php endforeach; ?>

        </div>
      <h4 class="mb-3 pb-3 text-secondary">Leave a Comment</h4>
<form action="insert_comment.php" method="POST" class="row">
  <div class="col-12">
    <textarea name="comment" id="comment" placeholder="Message" class="form-control mb-4 border" required></textarea>
  </div>
  <input type="hidden" name="id_news" value="<?php echo $id; ?>"> 
  <div class="col-md-2">
    <button type="submit" class="btn btn-secondary rounded-0">Send</button>
  </div>
</form>
      </div>
    </div>
  </div>
</section>

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
      <a href="./uploads/userAvatar/"></a>
        <?php
      
       while ($new = $news->fetch_assoc()) { ?>
            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
        <article class="card">
          <img src="./uploads/news/<?php echo htmlspecialchars($new['body']); ?>" alt="post-thumb" class="card-img-top mb-2">
          <div class="card-body p-0">
            <time><?php
            echo $new['publication_date'];
            
            ?></time>
            <p class="elipsis"><?php
            echo htmlspecialchars($new['descripcion']);
            ?></p>
            <a href="blog-single" class="h4 card-title d-block my-3 text-dark hover-text-underline"><?php
            
            echo htmlspecialchars($new['title']);
            ?></a>
            <a href="#" class="btn btn-transparent">Read more</a>
          </div>
        </article>
      </div>
                <?php } ?>
      </div>
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
              <input type="text" id="name" name="name" class="form-control mb-4 px-0" placeholder="Full name">
              <input type="text" id="name" name="name" class="form-control mb-4 px-0" placeholder="Email address">
              <textarea name="message" id="message" class="form-control mb-4 px-0" placeholder="Message"></textarea>
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
          <p class="text-light mb-0">PearOS Sulaiman © 2021, All Right Reserved</p>
        </div>
        <div class="col-md-6">
          <ul class="list-inline text-md-right text-center">
            <li class="list-inline-item"><a class="d-block p-3 text-white" href="#"><i class="ti-facebook"></i></a></li>
            <li class="list-inline-item"><a class="d-block p-3 text-white" href="#"><i class="ti-twitter-alt"></i></a></li>
            <li class="list-inline-item"><a class="d-block p-3 text-white" href="#"><i class="ti-instagram"></i></a></li>
            <li class="list-inline-item"><a class="d-block p-3 text-white" href="#"><i class="ti-github"></i></a></li>
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU&libraries=places"></script>
<script src="plugins/google-map/gmap.js"></script>

<!-- Main Script -->
<script src="js/script.js"></script>

</body>
</html>