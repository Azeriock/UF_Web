<?php
session_start();

include("config.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Heroic Features - Start Bootstrap Template</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/heroic-features.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="index.php">Lebontoin</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">

        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container">

    <!-- Jumbotron Header -->
    <header class="jumbotron my-4">
      <h1 class="display-3">Bienvenue</h1>
      <p class="text-white-75 font-weight-light mb-5"></p>
    </header>
<div class="background">
    <!-- Page Features -->
    <div class="row text-center">
      <div class="col-lg-3 col-md-6 mb-4 ">
        <div class="card h-100">
          <img class="card-img-top" src="images/automobile.png" alt="">
          <div class="card-body">
            <h4 class="card-title">VEHICULES</h4>
            <p class=" text-white-75 font-weight-light mb-5 "></p>
          </div>
          <div class="card-footer bg-dark">
            <a href="item.php?cat=vehicule" class="btn btn-secondary">Check!</a>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card h-100">
          <img class="card-img-top" src="images/clothes (1).png" alt="">
          <div class="card-body">
            <h4 class="card-title">MODE</h4>
            <p class="text-white-75 font-weight-light mb-5"></p>
          </div>
          <div class="card-footer bg-dark">
            <a href="item.php?cat=mode" class="btn btn-secondary">Check!</a>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card h-100">
          <img class="card-img-top" src="images/console.png" alt="">
          <div class="card-body">
            <h4 class="card-title">MULTIMEDIA</h4>
            <p class="text-white-75 font-weight-light mb-5"></p>
          </div>
          <div class="card-footer bg-dark">
            <a href="item.php?cat=multimedia" class="btn btn-secondary">Check!</a>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card h-100">
          <img class="card-img-top" src="images/armchair.png" alt="">
          <div class="card-body">
            <h4 class="card-title">MAISON</h4>
            <p class="text-white-75 font-weight-light mb-5"></p>
          </div>
          <div class="card-footer bg-dark">
            <a href="item.php?cat=maison" class="btn btn-secondary">Check!</a>
          </div>
        </div>
      </div>

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->
</div>
  <!-- Footer -->
  <footer class="py-5 bg-dark" style="margin-top: 350px;">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2019</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
