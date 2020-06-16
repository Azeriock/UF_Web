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

  <title>Page annonce</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/style1.css" rel="stylesheet">

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
        <ul class="navbar-nav ml-auto">
          <form method="POST" class="form-inline d-flex justify-content-center md-form form-sm mt-0">
            <i class="fas fa-search" aria-hidden="true"></i>
            <input class="form-control form-control-sm ml-3 w-75" name="search" type="text" placeholder="Search">
          </form>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->

  <div class="container">

    <div class="row">

      <div class="col-lg-3">
        <h1 class="my-4"><?php echo $_GET['cat'] ?></h1>
        <div class="list-group">
          <?php 
          if($_GET['cat'] == 'vehicule')
          {
          ?>
          <a href="item.php?cat=mode" class="list-group-item">Mode</a>
          <a href="item.php?cat=multimedia" class="list-group-item">Multimedia</a>
          <a href="item.php?cat=maison" class="list-group-item">Maison</a>
          <?php
          }
          elseif($_GET['cat'] == 'mode')
          {
          ?>
          <a href="item.php?cat=vehicule" class="list-group-item">Vehicule</a>
          <a href="item.php?cat=multimedia" class="list-group-item">Multimedia</a>
          <a href="item.php?cat=maison" class="list-group-item">Maison</a>
          <?php
          }
          elseif($_GET['cat'] == 'multimedia')
          {
          ?>
          <a href="item.php?cat=vehicule" class="list-group-item">Vehicule</a>
          <a href="item.php?cat=mode" class="list-group-item">Mode</a>
          <a href="item.php?cat=maison" class="list-group-item">Maison</a>
          <?php
          }
          elseif($_GET['cat'] == 'maison')
          {
          ?>
          <a href="item.php?cat=vehicule" class="list-group-item">Vehicule</a>
          <a href="item.php?cat=multimedia" class="list-group-item">Multimedia</a>
          <a href="item.php?cat=mode" class="list-group-item">Mode</a>
          <?php
          }
          ?>
          <a href="choix.php" class="list-group-item active">Retour</a>
        </div>

      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-9">

        <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
              <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="First slide">
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Second slide">
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Third slide">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>

        <div class="row">
          <?php
          if(isset($_POST['search']) AND !empty($_POST['search'])) // SYSTEME DE RECHERCHE
          {
            $recherche = htmlspecialchars($_POST['search']);
            $requete = $bdd->prepare("SELECT * FROM annonce WHERE catégorie = ? AND titre LIKE '%$recherche%' ");
            $requete->execute(array($_GET['cat']));
          }
          else
          {
            $requete = $bdd->prepare("SELECT * FROM annonce WHERE catégorie = ?");
            $requete->execute(array($_GET['cat']));
          }
          while($resultat = $requete->fetch())
          {
          ?>
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
              <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
              <div class="card-body">
                <h4 class="card-title">
                  <a href="desc.php?id=<?= $resultat['id_annonce']; ?>"><?php echo $resultat['titre'] ?></a>
                </h4>
                <h5><?php echo $resultat['prix'] . "€" ?></h5>
                <p class="card-text"><?php echo $resultat['description'] ?></p>
              </div>
              <div class="card-footer bg-dark">
                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
              </div>
            </div>
          </div>
          <?php
          }
          ?>
          
        </div>
        <!-- /.row -->

      </div>
      <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark" style="margin-top: 500px;">
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
