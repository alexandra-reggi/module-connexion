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
    if (isset($_SESSION["login"])) */toujours pareil si il est connu*/
    {
    ?>

        <p>Bonjour <?php echo $_SESSION['login'] ?> vous êtes dejà connecté.<br></p>

        <form action="index.php" method="post">
            <input class="mybutton_inscription" name="deco" value="Deconnexion" type="submit"/>
        </form>

        <?php
    }
        else                    */sinon il a un formulaire pour s_inscrire*/
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
        
            if (isset($_POST["valider"]))  */une fois remplis, ici lorsqu_il est valider*/
            {
            $login = $_POST["login"];               */tout devient les variable correspondante*/
            $prenom = $_POST["prenom"];
            $nom = $_POST["nom"];
            $mdp = password_hash ($_POST["mdp"], PASSWORD_BCRYPT);

            $connexion = mysqli_connect("localhost", "root", "","moduleconnexion");    */ se connecte à la base bdd et on verrifi tout*/
            $requete3 = "SELECT login FROM utilisateurs WHERE login = '$login'";
            $query3 = mysqli_query($connexion, $requete3);
            $resultat3 = mysqli_fetch_all($query3);

            if (!empty($resultat3))       */si ce login n_existe pas dejà...*/
            {
                echo "Ce login est delà prit";
            }

            elseif ($_POST["mdp"] != $_POST["mdpval"])  */si le mot de pass et le cconfirm sont bien identiques*/
            {
                echo "Attention! Mot de passe différent";
            }

            else                                        */et si tout va bien on Inserre tout dans la bdd*/
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

 */ Donc recap pour une inscription:
 - si la session est ouverte et que c'est un utilisteur on lui dit bonjour par son prenom et qu'il est dejà connecté;
 - sinon on affiche le formulaire d'inscription;
 - une fois rempli, lorsque le bouton valid et cliqué "if (isset($_POST["valider"]))",
 -tout devient leur variable,
 -on se connecte à la bdd,
 -on verrifi si login est unique,
 -si mdp et pareil que le confirm,
 -et si tout va bien on "INSER"tout dans la bdd./*