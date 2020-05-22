<?php session_start(); ?>

<!DOCTYPE html>

<html>

<head>
	<title>Module-connexion</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>

    <header>

        <nav>
            <ul>
                <li><a href= "index.php"> Accueil</a></li>
                <li><a href= "inscription.php"> Inscription</a></li>
                <li><a href= "connexion.php" >Connexion</a></li>
                <li><a href= "admin.php"> Profil</a></li>
                <li><a href= "profil.php"> Admin</a></li>
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

        <article id="phpmain">

        <?php

            date_default_timezone_set('Europe/Paris');
            if(isset($_SESSION['login']))
            {
            	?>
				    <section class= 'mainbas'>
				        <article class= 'text'>
				            <h2>Bonjour <?php echo $_SESSION["login"]?> et bienvenu sur mon site.</h1><br>
				        </article>

				        <article class= "etoile">
				            <img id= "imgetoile" src= "images/etoilefilante.gif">
                        </article>

				    </section>

                        <article class="acces">
				            <p>Nous sommes le <?php date('d-m-Y')?> et il est <?php date('H:i:s')?></p>
				            
                    <footer id= "foot_index">

                    <?php 
                        if($_SESSION['login'] == "admin")
				        {
                            echo "Vous êtes connecté en tant qu'administrateur et vous avez accès à la page <a href=\"admin.php\">ADMIN PANEL</a></p>";
                        }
                            
                            else
                            {
                            echo "Vous êtes connecté en tant qu'utilisateur. Accédez à votre page de <a href=\"profil.php\">PROFIL</a></p>";
                            }
                    ?>

                            <form action="index.php" method="post">
                                <input class="mybutton"  name="deco" value="Deconnexion" type="submit" />
                            </form>

                        </article>

                        </footer>
            <?php
            }
            
            else
            {
            ?>
            
				<section class= 'mainbas'>
				    <article class= 'text'>
				        <h2>Bonjour et bienvenu sur mon site.</h1><br>
				    </article>

				    <article class= "etoile">
				        <img class= "imgetoile" src= "images/etoilefilante.gif">
				    <article>

                </section>

                <footer id= "index">
                               
                    <article class="acces">
                        <p>Pour pouvoir accéder à votre profil veuillez visiter la page : <a href= "connexion.php">CONNEXION</a></p>
                        <p>Pas de compte ? Inscrivez-vous en remplissant le formulaire : <a href= "inscription.php">INSCRIPTION</a></p>
                    </article>

                </footer>

			<?php
            }

            if (isset($_POST["deco"]))
            {
            session_unset();
            session_destroy();
            }
        ?>
                    
        
</main>

</body>
