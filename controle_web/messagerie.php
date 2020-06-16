
<?php
session_start();

include("config.php");
if(isset($_SESSION['id']) AND !empty($_SESSION['id']))
{
        if($_SESSION['id'] == 1)
        {
            if(isset($_POST['envoi_message'])) // ENVOI MESSAGE
            {
                if(isset($_POST['message'], $_POST['destinataire']) AND !empty($_POST['message']) AND !empty($_POST['destinataire']))
                {
                    $destinataire = htmlspecialchars($_POST['destinataire']);
                    $message = htmlspecialchars($_POST['message']);
                    $id_destinataire = $bdd->prepare('SELECT id_user FROM user WHERE email = ?');
                    $id_destinataire->execute(array($destinataire));
                    $id_destinataire = $id_destinataire->fetch();
                    $id_destinataire = $id_destinataire['id_user'];

                    $insert = $bdd->prepare('INSERT INTO message(id_expediteur,id_destinataire,message) VALUES (?,?,?)');
                    $insert->execute(array($_SESSION['id'],$id_destinataire,$message));

                }
            }
        }
        else
        {
            if(isset($_POST['envoi_message'])) // ENVOI MESSAGE
            {
                if(isset($_POST['message']) AND !empty($_POST['message']))
                {
                    $destinataire = "admin@live.fr";
                    $message = htmlspecialchars($_POST['message']);
                    $id_destinataire = $bdd->prepare('SELECT id_user FROM user WHERE email = ?');
                    $id_destinataire->execute(array($destinataire));
                    $id_destinataire = $id_destinataire->fetch();
                    $id_destinataire = $id_destinataire['id_user'];

                    $insert = $bdd->prepare('INSERT INTO message(id_expediteur,id_destinataire,message) VALUES (?,?,?)');
                    $insert->execute(array($_SESSION['id'],$id_destinataire,$message));
                    header("Location: profil.php?id=".$_SESSION['id']);
                }
            }
        }

        $destinataire = $bdd->query('SELECT email FROM user');    
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
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/style4.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
            <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="index.php">Lebontoin</a><button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">Menu <i class="fas fa-bars"></i></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="profil.php?id=<?php echo $_SESSION['id'] ?>">Profil</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead bg-warning text-white text-center">
            <div class="container d-flex align-items-center flex-column">
               
            </div>
        </header>
        <!-- Portfolio Section-->
        <section class="page-section portfolio" id="portfolio">
        <div class="container">
                <!-- Contact Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Messagerie</h2>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- Contact Section Form-->
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19.-->
                        
                    </div>
                </div>
            </div>
            <form method="POST" action="">
                <?php 
                if($_SESSION['id'] == 1)
                {
                ?>
                <select name="destinataire" id="">
                <?php while($d = $destinataire->fetch()) 
                { ?>
                <option value="<?php echo $d['email'] ?>"><?php echo $d['email'] ?></option>
                <?php 
                } ?>
                </select>
                <?php 
                }
                ?>
                <textarea name="message" id="" cols="30" rows="10"></textarea>
                <br>
                <input type="submit" value="envoyer" name="envoi_message">
            </form>
            <br><br>
            <?php 
            $msg = $bdd->prepare('SELECT * FROM message WHERE id_destinataire = ?');
            $msg->execute(array($_SESSION['id']));

            while($m = $msg->fetch())
            {
                $p_exp = $bdd->prepare('SELECT prenom FROM user WHERE id_user = ?');
                $p_exp->execute(array($m['id_expediteur']));
                $p_exp = $p_exp->fetch();
                $p_exp = $p_exp['prenom'];
            ?>
            <b><?= $p_exp ?></b> : <br>
            <?= $m['message'] ?><br>
            <?php
            }
            ?>
        </section>
        <!-- About Section-->
        <section class="page-section bg-warning text-white mb-0" id="about">

        </section>
        <!-- Contact Section-->
        
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
        <script src="assets/mail/jqBootstrapValidation.js"></script>
        <script src="assets/mail/contact_me.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>

<?php 
} 
?>