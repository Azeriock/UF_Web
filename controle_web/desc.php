<?php
session_start();
include("config.php");
if (!isset($_GET["id"]))
  header("location:404.php");
else if(empty($_GET["id"]))
  header("location:404.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Shop Item - product list-group</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/shop-item.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="index.php">LebonToin</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container">

    <div class="row">
    <?php
      $req = $bdd->query("SELECT * FROM annonce AS an INNER JOIN user AS us ON an.id_proprietaire = us.id_user WHERE id_annonce = ".$_GET["id"]);
      $res = $req->fetch();
    ?>
      <div class="col-lg-3">
        <h1 class="my-4">Shop Name</h1>
        <div class="list-group">
          <a href="#" class="list-group-item active">info du vendeur</a>
          <a href="#" class="list-group-item"><?= $res["nom"] ?> <?= $res["prenom"] ?></a>
          <a href="#" class="list-group-item"><?= $res["email"] ?></a>
          <a href="item.php?cat=<?php echo $res['catégorie'] ?>" class="list-group-item active">Retour</a>
        </div>
      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-9">

        <div class="card mt-4">
        <!-- Change vers cette ligne si tu veut afficher une image depuis la base de donnee -->
        <!--<img class="card-img-top img-fluid" src="<?= $res["photo"] ?> alt=""> -->
          <img class="card-img-top img-fluid" src="http://placehold.it/900x400" alt="">
          <div class="card-body">
            <h3 class="card-title"><?= $res["titre"] ?></h3>
            <h4><?= $res["prix"] ?></h4>
            <p class="card-text"><?= $res["nom"] ?></p>
            <span class="text-warning">&#9733; &#9733; &#9733; &#9733; &#9734;</span>
            4.0 stars
          </div>
        </div>
        <!-- /.card -->

        <div class="card card-outline-secondary my-4">
          <div class="card-header">
            Product Reviews
          </div>
          <div class="card-body">
            <p><?= $res["description"] ?></p>
            <a href="#" class="btn btn-success">Commander</a>
          </div>
        </div>
        <!-- /.card -->

      </div>
      <!-- /.col-lg-9 -->

    </div>

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark">
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
