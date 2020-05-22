<!DOCTYPE html>

<html>

<head>
	<title>Moduleconnexion</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>

    <header>

        <nav>
            <ul>
                <li><a href= "index.php"> Accueil</a></li>
                <li><a href= "inscription.php"> Inscription</a></li>
                <li><a id="color2" href= "connexion.php" >Connexion</a></li>
                <li><a href= "admin.php"> Profil</a></li>
                <li><a href= "profil.php"> Admin</a></li>
            </ul>
        </nav>

    </header>

<main>

    <section id="main_connect">

        <article>
            <img id="imgconnect" src="images/etoile.gif">
        </article>


    <?php

$cnx = mysqli_connect("localhost", "root", "", "moduleconnexion");
session_start();

if (isset($_SESSION["login"]))
{
?>

    <p>Bonjour <?php echo $_SESSION ?> vous êtes dejà connecté donc dejà inscrit.<br></p>

    <form action="index.php" method="post">
        <input class="mybutton" name="deco" value="Deconnexion" type="submit"/>
    </form>

    <?php
}

    if ((!isset($_POST["login"]) || !isset($_POST["password"])) && (!isset($_SESSION["login"]))) 
    {
    ?>

        <form action="connexion.php" metho="post" id="form_connect">

        <label>Login</label>
        <input type="text" name="login">

        <label>Password</label>
        <input type="text" name="password">

        <input class="mybutton" type="submit" value="Connexion" name="valider">

        </form>

<?php
    }

if (isset($_POST['login']) && isset($_POST['password'])) 
{   
    $requete2 = "SELECT * FROM utilisateurs WHERE login ='" . $_POST['login'] . "'";
    $query2 = mysqli_query($cnx, $requete2);
    $resultat = mysqli_fetch_array($query2);

    if (!empty($resultat)) 
    {
        if (password_verify($_POST['password'], $resultat['password'])) 
        {
            $_SESSION['login'] = $_POST['login'];
            $_SESSION['password'] = $_POST['password'];
            header('Location:index.php');
        }

    else{
?>
        <p>Vôtre mot de passe est incorrect</p>

        <form action="connexion.php" metho="post" class="formulaire">

        <label>Login</label>
        <input type="text" name="login">

        <label>Password</label>
        <input type="text" name="password">

        <input class="mybutton" type="submit" value="Connexion" name="valider">

        </form>

        <?php
        }   
    }    
    else{
        ?>

        <p>Votre nom d'utilisateur n'est pas valide</p>

        <form action="connexion.php" metho="post" class="formulaire">

        <label>Login</label>
        <input type="text" name="login">

        <label>Password</label>
        <input type="text" name="password">

        <input class="mybutton" type="submit" value="Connexion" name="valider">

        </form>

        <?php
        }
    }

mysqli_close($cnx);

        ?>

    </section>

</main>

<footer id= "foot_connect">
<nav class="navfoot">
            <a href="inscription.php">ACCUEIL</a>
            <a href="inscription.php">INSCRIPTION</a>
            <a id="colorf2" href="connexion.php">CONNEXION</a>
            <a href="admin.php">ADMIN</a>
            <a href="profil.php">PROFIL</a>
        </nav>
        <article>
            <p><b>Copyright 2019 Coding School | All Rights Reserved | Project by Alexandra REGGI.<b></p>
        </article>
    </footer>

</body>

</html>



    


