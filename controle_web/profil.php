<?php
session_start();

include("config.php");

if(isset($_SESSION['id']) AND !empty($_SESSION['id']))
{
    if(isset($_GET['id']) AND $_GET['id'] > 0) // VERIFICATION CONNEXION
    {
        $getid = intval($_GET['id']);
        $requser = $bdd->prepare('SELECT * FROM user WHERE id_user = ?');
        $requser->execute(array($getid));
        $userinfo = $requser->fetch();
    }

    if(isset($_POST['formannonce']))		// AJOUT ANNONCE
    {
        $titre = htmlspecialchars($_POST['titre']);
        $prix = htmlspecialchars($_POST['prix']);
        $date = htmlspecialchars($_POST['date']);
        $description = htmlspecialchars($_POST['description']);
        $statut = 'actif';
        $categorie = htmlspecialchars($_POST['categorie']);
        if(!empty($_POST['titre']) AND
        !empty($_POST['prix']) AND
        !empty($_POST['date']) AND
        !empty($_POST['description']) AND
        !empty($_POST['categorie']))
        {
            $test = 'ok';
            $insertannonce = $bdd->prepare("INSERT INTO annonce(titre, prix, description, date_publication, statut, catégorie, id_proprietaire, photo) VALUES(?,?,?,?,?,?,?,?)");
            $insertannonce->execute(array($titre, $prix, $description, $date, $statut, $categorie, $_SESSION['id'], "default.jpg"));
        }
    } // FIN AJOUT ANNONCE

    if(isset($_SESSION['id']) AND $userinfo['id_user'] == $_SESSION['id'])
    {
?>
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
            <meta name="description" content="" />
            <meta name="author" content="" />
            <title>Freelancer - Start Bootstrap Theme</title>
            <!-- Favicon-->
            <link rel="icon" type="image/x-icon" href="assets2/img/favicon.ico" />
            <!-- Font Awesome icons (free version)-->
            <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
            <!-- Google fonts-->
            <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
            <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
            <!-- Core theme CSS (includes Bootstrap)-->
            <link href="css/style4.css" rel="stylesheet" />
            <link href="css/style5.css" rel="stylesheet" />
        </head>
        <body id="page-top">
            <!-- Navigation-->
            <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
                <div class="container">
                    <a class="navbar-brand js-scroll-trigger" href="index.php">Lebontoin</a><button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">Menu <i class="fas fa-bars"></i></button>
                    <div class="collapse navbar-collapse" id="navbarResponsive">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#portfolio">annonces</a></li>
                            <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#about">messages</a></li>
                            <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#contact">ajout</a></li>
                            <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="profil2.php?id=<?php echo $_SESSION['id'] ?>">Modifier son profil</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- Masthead-->
            <header class="masthead bg-warning text-white text-center">
                <div class="container d-flex align-items-center flex-column">
                    <!-- Masthead Avatar Image--><img class="masthead-avatar mb-5" src="img/<?php echo $userinfo['photo'] ?>" alt="" /><!-- Masthead Heading-->
                    <h1 class="masthead-heading text-uppercase mb-0"><?php echo $userinfo['nom'] ?> <?php echo $userinfo['prenom'] ?></h1>
                    <!-- Icon Divider-->
                    <div class="divider-custom divider-light">
                        <div class="divider-custom-line"></div>
                        <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                        <div class="divider-custom-line"></div>
                    </div>
                    <!-- Masthead Subheading-->
                    <p class="masthead-subheading font-weight-light mb-0">Bienvenue sur votre profil Lebontoin</p>
                </div>
            </header>
            <!-- Portfolio Section-->
            <section class="page-section portfolio bg-secondary" id="portfolio">
                <div class="container">
                    <!-- Portfolio Section Heading-->
                    <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Mes annonces</h2>
                    <!-- Icon Divider-->
                    <div class="divider-custom">
                        <div class="divider-custom-line"></div>
                        <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                        <div class="divider-custom-line"></div>
                    </div>
                    <!-- Portfolio Grid Items-->
                    <div class="row">
                        <!-- Portfolio Item -->
                        <?php 
                        $mesannonces = $bdd->prepare("SELECT * FROM annonce WHERE id_proprietaire = ?");
                        $mesannonces->execute(array($_SESSION['id']));
                        while($result = $mesannonces->fetch())
                        {
                        ?>
                        <div class="col-md-6 col-lg-4 mb-5">
                            <div class="portfolio-item mx-auto" data-toggle="modal" data-target="#portfolioModal<?= $result["id_annonce"]; ?>">
                                <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                    <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="assets2/img/portfolio/cabin.png" alt="" />
                            </div>
                        </div>


            <div class="portfolio-modal modal fade" id="portfolioModal<?= $result["id_annonce"]; ?>" tabindex="-1" role="dialog" aria-labelledby="portfolioModal<?= $result["id_annonce"]; ?>Label" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fas fa-times"></i></span>
                        </button>
                        
                        <div class="modal-body text-center">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8">
                                    <form action="#" method="POST">
                                        <!-- Portfolio Modal - Title-->
                                        <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0" id="portfolioModal<?= $result["id_annonce"]; ?>Label">
                                        <input type="test" name="id" value="<?= $result["id_annonce"]; ?>" HIDDEN>
                                        <input type="text" name="titre" value="<?= $result["titre"]; ?>" style="border:none;">
                                        </h2>
                                        <!-- Icon Divider-->
                                        <div class="divider-custom">
                                            <div class="divider-custom-line"></div>
                                            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                            <div class="divider-custom-line"></div>
                                        </div>
                                        <!-- Portfolio Modal - Image--><img class="img-fluid rounded mb-5" src="assets2/img/portfolio/cabin.png" alt="" /><!-- Portfolio Modal - Text-->
                                        <select name="categorie" class="form-control" placeholder="Categorie" data-validation-required-message="veuillez choisir une categorie.">
                                            <option value="vehicule">Vehicule</option>
                                            <option value="mode">Mode</option>
                                            <option value="multimedia">Multimedia</option>
                                            <option value="maison">Maison</option>
                                        </select><br>
                                        <label>Prix :</label><input type="number" step="0.01" class="form-control" name="prix" value="<?= $result["prix"]; ?>" style="border:none;"></br>
                                        <label>Description : </label><br><textarea name="desc" class="form-control" style="border:none;"><?= $result["description"]; ?></textarea></br>
                                        <input type="submit" name="save" class="btn btn-primary" value="save">
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                        <?php
                        }
                        if(isset($_POST["save"])) // MODIFICATION ANNONCE
                        {
                            $id = $_POST["id"];
                            $title = $_POST["titre"];
                            $price = $_POST["prix"];
                            $desc = $_POST["desc"];
                            $categorie = $_POST["categorie"];

                            $upd = $bdd->prepare("UPDATE annonce SET titre = ?, prix = ?, catégorie = ?, description = ? WHERE id_annonce = ?");
                            $upd->execute(array($title, $price, $categorie, $desc, $id));
                        }
                        ?>
                    </div>
                </div>
            </section>
            <!-- About Section-->
            <section class="page-section bg-warning text-white mb-0" id="about">
                <div class="container">
                    <!-- About Section Heading-->
                    <h2 class="page-section-heading text-center text-uppercase text-white">Messagerie</h2>
                    <!-- Icon Divider-->
                    <div class="divider-custom divider-light">
                        <div class="divider-custom-line"></div>
                        <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                        <div class="divider-custom-line"></div>
                    </div>
                    <!-- About Section Content-->
                    <div class="row">
                        <div class="col-lg-4 ml-auto"><p class="lead"></p></div>
                        <div class="col-lg-4 mr-auto"><p class="lead"></br></p></div>
                    </div>
                    <!-- About Section Button-->
                    <div class="text-center mt-4">
                        <a class="btn btn-xl btn-outline-light" class="addClass" href="messagerie.php"><i class="fas fa-download mr-2"></i>Acceder</a>
                    </div>
                </div>
            </section>
            <!-- Contact Section-->
            <section class="page-section" id="contact">
                <div class="container">
                    <!-- Contact Section Heading-->
                    <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Ajouter une annonce</h2>
                    <!-- Icon Divider-->
                    <div class="divider-custom">
                        <div class="divider-custom-line"></div>
                        <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                        <div class="divider-custom-line"></div>
                    </div>
                    <!-- Contact Section Form-->
                    <div class="row">
                        <div class="col-lg-8 mx-auto">
                            <form method="POST" enctype="multipart/form-data">
                                
                                <label>Titre de l'annonce </label><input class="form-control" type="text" name="titre" placeholder="Titre de l'annonce" data-validation-required-message="Veuillez indiquez un nom a votre annonce." />
   
                                <label>Date de publication</label><input class="form-control" type="date" name="date" placeholder="date" data-validation-required-message="Veuillez indiquez la date de publication." /> 
                                
                                <label>Prix</label><input type="number" step="0.01" class="form-control" name="prix" placeholder="Prix" data-validation-required-message="veuillez entrer le prix souhaité." /> 
                                    
                                <label>Description</label><input type="text" name="description" class="form-control" placeholder="Description" data-validation-required-message="veuillez indiquez une description.">

                                <label>Categorie</label>
                                <select name="categorie" class="form-control" placeholder="Categorie" data-validation-required-message="veuillez choisir une categorie.">
                                    <option value="vehicule">Vehicule</option>
                                    <option value="mode">Mode</option>
                                    <option value="multimedia">Multimedia</option>
                                    <option value="maison">Maison</option>
                                </select>
                                <br />
                                <input type="submit" name="formannonce" class="btn btn-warning btn-xl" value="Confirmer">
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Footer-->
            <footer class="footer text-center">
                <div class="container">
                    <div class="row">
                        <!-- Footer Location-->
                        <div class="col-lg-4 mb-5 mb-lg-0">
                            <h4 class="text-uppercase mb-4">Location</h4>
                            <p class="lead mb-0">2215 John Daniel Drive<br />Clark, MO 65243</p>
                        </div>
                        <!-- Footer Social Icons-->
                        <div class="col-lg-4 mb-5 mb-lg-0">
                            <h4 class="text-uppercase mb-4">Around the Web</h4>
                            <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-facebook-f"></i></a><a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-twitter"></i></a><a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-linkedin-in"></i></a><a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-dribbble"></i></a>
                        </div>
                        <!-- Footer About Text-->
                        <div class="col-lg-4">
                            <h4 class="text-uppercase mb-4">About Freelancer</h4>
                            <p class="lead mb-0">Freelance is a free to use, MIT licensed Bootstrap theme created by <a href="http://startbootstrap.com">Start Bootstrap</a>.</p>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- Copyright Section-->
            <div class="copyright py-4 text-center text-white">
                <div class="container"><small>Copyright © Your Website 2020</small></div>
            </div>
            <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes)-->
            <div class="scroll-to-top d-lg-none position-fixed">
                <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top"><i class="fa fa-chevron-up"></i></a>
            </div>
        
            <!-- Bootstrap core JS-->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
            <!-- Third party plugin JS-->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
            <!-- Contact form JS-->
            <script src="assets2/mail/jqBootstrapValidation.js"></script>
            <script src="assets2/mail/contact_me.js"></script>
            <!-- Core theme JS-->
            <script src="js/scripts.js"></script>
            <script type="text/javascript" src="js/chat.js"></script>
        </body>
    </html>
<?php
    }
}
else
{
    header("Location: index.php"); 
}
?>