<!DOCTYPE html>

<html>

<head>
    <title>Module-connexion/Connexion</title>
    <meta sharset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>

    <header>

        <nav>
            <ul>
                <li><a href= "index.php"> Accueil</a></li>
                <li><a href= "inscription.php"> Inscription</a></li>
                <li><a id="color2" href= "connexion.php" >Connexion</a></li>
                <li><a href= "profil.php"> Profil</a></li>
                <li><a href= "admin.php"> Admin</a></li>
            </ul>
        </nav>

    </header>

<main id= "main_connexion">

    <section id="sect1_main_connection">

        <article>
            <img id="imgconnect" src="images/etoile.gif">
        </article>


    <?php

$cnx = mysqli_connect("localhost", "root", "", "moduleconnexion");

session_start();


if (isset($_SESSION["login"]))
{
?>

    <section id= "sect2_main_connexion">

        <p id="message1_main_connexion">~ Bonjour <?php echo $_SESSION['login'] ?> vous êtes dejà connecté ~<br></p>

        <form action="index.php" method="post">
            <input class="mybutton_connexion" name="deco" value="Deconnexion" type="submit"/>
        </form>

    </section>


    <?php
}
                           
    if ((!isset($_POST["login"]) || !isset($_POST["password"])) && (!isset($_SESSION["login"]))) 
    {
      
    ?>

        <form action="connexion.php" method="post" id="form_connect">

        <label clas="label_connexion">Login</label>
        <input class="input_connexion" type="text" name="login" required>

        <label clas="label_connexion">Password</label>
        <input class="input_connexion" type="text" name="password" required>

        <input class="mybutton_connexion" type="submit" value="Connexion" name="valider">

        </form>

<?php
    }

if (isset($_POST['login']) && isset($_POST['password']))// */si un login et un password ont été postés*/ 

{   

    $requete2 = "SELECT * FROM utilisateurs WHERE login ='" . $_POST['login'] . "'"; 
    // */on consulte le login dans la bdd*/
    $query2 = mysqli_query($cnx, $requete2);
    $resultat = mysqli_fetch_array($query2);


    if (!empty($resultat))// */s'il n'est pas vide donc existant*/ 
    
    {
        if (password_verify($_POST['password'], $resultat['password']))//et si le password posté est bien le même que celui dans la bdd*/ 
        
        {
            $_SESSION['login'] = $_POST['login'];  
           
            $_SESSION['password'] = $_POST['password'];
            header('Location:index.php');
        }
                            
    else{
?>
        <p>Vôtre mot de passe est incorrect</p>

        <form action="connexion.php" method="post" class="formulaire">

        <label clas="label_connexion">Login</label>
        <input class="input_connexion" type="text" name="login" required>

        <label clas="label_connexion">Password</label>
        <input class="input_connexion" type="text" name="password" required>

        <input class="mybutton_connexion" type="submit" value="Connexion" name="valider">

        </form>

        <?php
        }   
    }    
    else{   
        
        ?>

        <p>Votre nom d'utilisateur n'est pas valide</p>

        <form action="connexion.php" method="post" class="formulaire">

        <label clas="label_connexion">Login</label>
        <input class="input_connexion" type="text" name="login" required>

        <label clas="label_connexion">Password</label>
        <input class="input_connexion" type="text" name="password" required>

        <input class="mybutton_connexion" type="submit" value="Connexion" name="valider">

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



    


