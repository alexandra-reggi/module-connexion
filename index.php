<?php session_start(); ?>

<!DOCTYPE html>

<html>

<head>
    <title>Module-connexion/index</title>
    <meta sharset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>

    <header>  
        <!-- */faire une barre nav en php/* -->


        <nav>
            <ul>
                <li><a id="color" href= "index.php"> Accueil</a></li>
                <li><a href= "inscription.php"> Inscription</a></li>
                <li><a href= "connexion.php" >Connexion</a></li>
                <li><a href= "profil.php"> Profil</a></li>
                <li><a href= "index.php"> Admin</a></li>
            </ul>
        </nav>

    </header>

<main>

    <section id= "main_index">

        <article id="titremain">
            <h1>Le Site d'Alex</h1>
        </article>


        <article id="imgmain">
            <img src= "images/imgalex.gif">
        </article>

    </section>

    <section class= 'mainbas'>

        <article id="phpmain">

            <?php
            date_default_timezone_set('Europe/Paris');
            if(isset($_SESSION['login'])) 
            // Si la session est ouverte par quelqu_un
            {
            ?>

        </article>

		<article class= 'text'>
            <h2>Bonjour <?php echo $_SESSION["login"]?> et bienvenu sur mon site.</h1><br> 
            <!-- si c_est un inscrit son nom est reconnu*/ -->
		</article>

		<article class= "etoile">
			<img id= "imgetoile" src= "images/etoilefilante.gif">
        </article>

        <article class="acces">
            
            <p>Nous sommes le <?php echo date('d-m-Y')?> et il est <?php echo date('H:i:s')?></p>
                               
                <?php 
                    if($_SESSION['login'] == "admin") 
                    // Si c_est l_admin
				    {
                        echo "<p>Vous êtes connecté en tant qu'administrateur et vous avez accès à la page <a id=\"AD1\" href=\"admin.php\">ADMIN</a></p>";
                    }
                                                        // ou sinon si c_est l_utilisteur*/
                    else
                    {
                        echo "<p>Vous êtes connecté en tant qu'utilisateur. Accédez à votre page de <a id=\"AD2\" href=\"profil.php\">PROFIL</a></p>";
                    }
                ?>             
                <!-- */du coup il leur faut à eux un bouton pour se deconnecté puisque le barre nav n-est pas PHP.../* -->

            <form action="index.php" method="post">
                <input id="mybutton_index"  name="deco" value="Deconnexion" type="submit" />
            </form>

        </article>
    
                       
            <?php
            }
            
            else    
            // */et si c_est un inconu...*/
            {
            ?>
            
		<article class= 'text'>
			<h2>Bonjour et bienvenu sur mon site.</h1><br>
		</article>

		<article class= "etoile">
			<img class= "imgetoile" src= "images/etoilefilante.gif">
		<article>

            <?php  
            // */à la fin dans tous les cas si le bouton deconnexion est cliqué la session est detruite*/
            }

            if (isset($_POST["deco"]))
            {
            session_unset();
            session_destroy();
            header('Location:index.php');
            }
            ?>

    </section>
</main>

    <footer id= "index">
                               
        <article class="acces">
            <p>Pour pouvoir accéder à votre profil veuillez visiter la page : <a href= "connexion.php">CONNEXION</a></p>
            <p>Pas de compte ? Inscrivez-vous en remplissant le formulaire : <a href= "inscription.php">INSCRIPTION</a></p>
        </article>

    </footer>

</body>
</html>

