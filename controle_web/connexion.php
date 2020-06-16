<?php
session_start();

include("config.php");

if(isset($_POST['forminscription'])) //  INSCRIPTION
{
	$nom = htmlspecialchars($_POST['nom']);
	$prenom = htmlspecialchars($_POST['prenom']);
	$email = htmlspecialchars($_POST['email']);
	$password = sha1($_POST['password']);
	$reqmail = $bdd->prepare("SELECT * FROM user WHERE email = ?");
	$reqmail->execute(array($email));
	$mailexist = $reqmail->rowCount();
	if($mailexist == 0)
	{
		if(!empty($_POST['nom']) AND
			!empty($_POST['prenom']) AND
			!empty($_POST['email']) AND
			!empty($_POST['password']))
		{
			$insertuser = $bdd->prepare("INSERT INTO user(nom, prenom, email, password, photo) VALUES(?,?,?,?,?)");
            $insertuser->execute(array($nom, $prenom, $email, $password, "default.jpg"));
            header("Location: connexion.php");
		}
	}
	else
	{
		$erreur = "Adresse mail deja utilisée";
	}
}           //       FIN D'INSCRIPTION

if(isset($_POST['formconnexion']))  // CONNEXION
{
	$mailconnect = htmlspecialchars($_POST['mailconnect']);
	$mdpconnect = sha1($_POST['mdpconnect']);
	if(!empty($mailconnect) AND !empty($mdpconnect))
	{
		$requser = $bdd->prepare("SELECT * FROM user WHERE email = ? AND password = ?");
		$requser->execute(array($mailconnect, $mdpconnect));
		$userexist = $requser->rowCount();
		if($userexist == 1)
		{
			$userinfo = $requser->fetch();
			$_SESSION['id'] = $userinfo['id_user'];
			$_SESSION['nom'] = $userinfo['nom'];
			$_SESSION['prenom'] = $userinfo['prenom'];
			$_SESSION['mail'] = $userinfo['email'];
            $_SESSION['photo'] = $userinfo['photo'];
            header("Location: index.php?id=".$_SESSION['id']);
		}
		else
		{
			$erreur = "Email ou mot de passe incorrect";
		}
	}
}			// 		FIN CONNEXION
?>
<html>
<head>
    <title>Login and registration Form </title>
    <link rel="stylesheet" href="css/style3.css">
</head>
<body>
    <div class="hero">
        <div class="form-box">
            <div class="button-box">
                <div id="btn"></div>
                <button type="button" class="toggle-btn" onclick="login()">Login</button>
                <button type="button" class="toggle-btn" onclick="register()">Register</button>
            </div>
            <div class="social-icons">
                <img src="images/facebook.png">
                <img src="images/twitter.png">
                <img src="images/instagram.png">
            </div>
            <form method="POST" id="login" class="input-group">
                <input type="email" name="mailconnect" class="input-field" placeholder="E-mail" required>
                <input type="password" name="mdpconnect" class="input-field" placeholder="mot de passe" required>
                <input type="submit" name="formconnexion" class="submit-btn" value="Se connecter">
            </form>
            <form method="POST" id="register" class="input-group">
                <input type="text" name="nom" class="input-field" placeholder="Nom" required>
                <input type="text" name="prenom" class="input-field" placeholder="Prenom" required>
                <input type="mail" name="email" class="input-field" placeholder="E-mail" required>
                <input type="password" name="password" class="input-field" placeholder="mot de passe" required>
                <input type="submit" name="forminscription" class="submit-btn" value="S'inscrire">
            </form>
        </div>

    </div>
    <script>
        var x = document.getElementById("login");
        var y = document.getElementById("register");
        var z = document.getElementById("btn");
        
        function register() {
            x.style.left = "-400px";
            y.style.left = "50px";
            z.style.left ="110px";
        }
        function login() {
            x.style.left = "50px";
            y.style.left = "450px";
            z.style.left = "0px";
        }

    </script>
</body>
</html>