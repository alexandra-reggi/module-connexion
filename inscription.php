<?php session_start(); ?>

<!DOCTYPE html>

<html>

<head>
    <title>Module-connexion/Inscription</title>
    <meta sharset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>

    <header>
        <nav>
            <ul>
                <li><a href= "index.php"> Accueil</a></li>
                <li><a id="color1" href= "inscription.php"> Inscription</a></li>
                <li><a href= "connexion.php" >Connexion</a></li>
                <li><a href= "profil.php"> Profil</a></li>
                <li><a href= "admin.php"> Admin</a></li>
            </ul>
        </nav>

    </header>

<main>

    <section id="main_inscription">

    <?php
    if (isset($_SESSION["login"])) 
    {
    ?>

        <p id="bjr_main_inscription">~ Bonjour <?php echo $_SESSION['login'] ?> vous êtes dejà connecté ~<br></p>

        <form action="index.php" method="post">
            <input class="mybutton_inscription" name="deco" value="Deconnexion" type="submit"/>
        </form>

        <?php
    }
        else                    
        {
        ?>

            <article id="titre_inscript">
                <img id="imginscript" src= "images/subscribe.png">
            </article>

               <form method="post" id="form_inscript">

                    <label class="label_inscription">Login</label>
                    <input class="input_inscription" type="text" name="login" required>

                    <label class="label_inscription">Prénom</label>
                    <input class="input_inscription" type="text" name="prenom" required>

                    <label class="label_inscription">Nom</label>
                    <input class="input_inscription" type="text" name="nom" required>

                    <label class="label_inscription">Password</label>
                    <input class="input_inscription" type="password" name="mdp" required>

                    <label class="label_inscription">Password confirmation</label>
                    <input class="input_inscription" type="password" name="mdpval" required>

                    <input class="mybutton_inscription" type="submit" value="S'INSCRIRE" name="valider">

                </form>

        <?php
        }
        
            if (isset($_POST["valider"]))  
            {
            $login = $_POST["login"];               
            $prenom = $_POST["prenom"];
            $nom = $_POST["nom"];
            $mdp = password_hash ($_POST["mdp"], PASSWORD_BCRYPT);

            $connexion = mysqli_connect("localhost", "root", "","moduleconnexion");    
            $requete3 = "SELECT login FROM utilisateurs WHERE login = '$login'";
            $query3 = mysqli_query($connexion, $requete3);
            $resultat3 = mysqli_fetch_all($query3);

            if (!empty($resultat3))       
            {
                echo "Ce login est delà prit";
            }

            elseif ($_POST["mdp"] != $_POST["mdpval"])  
            {
                echo "Attention! Mot de passe différent";
            }

            else                                       
            {
                $requete = "INSERT INTO utilisateurs (login, prenom, nom, password) VALUE ('$login', '$prenom', '$nom', '$mdp')";
                $query = mysqli_query($connexion, $requete);
                header("location:connexion.php");
            }

            }
        ?>

    </section>
</main>

<footer id= "foot_inscript">
<nav class="navfoot">
            <a href="inscription.php">ACCUEIL</a>
            <a id="colorf1" href="inscription.php">INSCRIPTION</a>
            <a href="connexion.php">CONNEXION</a>
            <a href="admin.php">ADMIN</a>
            <a href="profil.php">PROFIL</a>
        </nav>
        <article>
            <p><b>Copyright 2019 Coding School | All Rights Reserved | Project by Alexandra REGGI.<b></p>
        </article>
    </footer>

</body>

</html>

 