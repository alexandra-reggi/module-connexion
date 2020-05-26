<?php session_start()?>

<!DOCTYPE html>

<html>

<head>
    <title>Module-connexion/Profil</title>
    <meta sharset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>

    <header>

        <nav>
            <ul>
                <li><a href= "index.php"> Accueil</a></li>
                <li><a href= "inscription.php"> Inscription</a></li>
                <li><a href= "connexion.php" >Connexion</a></li>
                <li><a id="color4" href= "profil.php"> Profil</a></li>
                <li><a href= "admin.php"> Admin</a></li>
            </ul>
        </nav>

    </header>

    <main id= "main_profil">

    <section id="section_profil_gauche">

    <?php

    if (isset($_SESSION['login']))
    {
        $connexion= mysqli_connect("localhost", "root", "","moduleconnexion");
        $requete= "SELECT * FROM utilisateurs WHERE login= '". $_SESSION['login']."'";
        $query= mysqli_query($connexion, $requete);
        $resultat= mysqli_fetch_assoc($query);
    ?>

        <form id="form_profil_gauche" action="profil.php" method="post">
            <label class="label_gauche">Login</label>
            <input type="text" name="login" value=<?php echo $resultat['login'];?>/>
            <labe class="label_gauche">Prenom</label>
            <input type="text"  name="prenom" value= <?php echo $resultat['prenom'];?>/>
            <label class="label_gauche">Nom</label>
            <input type="text" name="nom" value= <?php echo $resultat['nom'];?>/>
            <input id="profil_ID" name="ID" type="hidden" value=<?php echo $resultat['id']; ?> />
            <input id="mybutton_profil_gauche" type="submit" name="modifier" value="Modifier" />
        </form>
         
        <?php
            if (isset($_POST['modifier']))
            {
                $login= $_POST["login"];
                $prenom= $_POST["prenom"];
                $nom= $_POST_POST["nom"];
                $req = "SELECT login FROM utilisateurs WHERE login = '$login'";
                $req3 = mysqli_query($connexion, $req);
                $veriflog = mysqli_fetch_all($req3);

                if(!empty($veriflog))
                   {
                      echo "Login deja utilisé, requete refusé.<br>";
                   }

               if(empty($veriflog))
                   {
                       $updatelog = "UPDATE utilisateurs SET login ='" . $_POST['login'] . "' WHERE id = '" . $resultat['id'] . "'";
                       $querylog = mysqli_query($connexion, $updatelog); 
                       $_SESSION['login']=$_POST['login'];
                       header("Location:profil.php");  
                   }

               if($resultat['prenom'] != $prenom )
                   {
                       $updateprenom = "UPDATE utilisateurs SET prenom ='" . $_POST['prenom'] . "' WHERE id = '" . $resultat['id'] . "'";
                       $queryprenom = mysqli_query($connexion, $updateprenom);
                       header("Location:profil.php");   
                   }

               if($resultat['nom'] != $nom )
                   {
                       $updatenom = "UPDATE utilisateurs SET nom ='" . $_POST['nom'] . "' WHERE id = '" . $resultat['id'] . "'";
                       $querynom = mysqli_query($connexion, $updatenom);
                       header("Location:profil.php"); 
                   }
            }
        
        ?>

        </section>

        <img id="image_profil" src="images/baguette.png">

         <section id="section_profil_droit"> 
                 <form id="form_profil_droit" action="profil.php" method="post">
                    <label class="label_droite"> New Password </label>
                    <input type="password" name="passwordx" />
                    <label class="label_droite"> Confirm New Password </label>
                    <input type="password" name="passwordconf" />
                    <input id="prodId" name="ID" type="hidden" value=<?php echo $resultat['id']; ?> />
                    <input id="mybutton_profil_droit" type="submit" name="modifier2" value="Modifier MDP" />
                </form>

         <?php 
                if (isset($_POST['modifier2'])) 
                    {
                       if ($_POST["passwordx"] != $_POST["passwordconf"]) 
                          {
                            echo "Attention ! Mots de passe différents";
                          } 
                       elseif(isset($_POST['passwordx']))
                       {
                            $pwdx = password_hash($_POST['passwordx'], PASSWORD_BCRYPT, array('cost' => 12));
                            $updatepwd = "UPDATE utilisateurs SET password = '$pwdx' WHERE id = '" . $resultat['id'] . "'";
                            $query2 = mysqli_query($connexion, $updatepwd);

                            echo "votre mot de passe a bien ete modifier";
                           ?>
                            <form action="index.php" method="post">
                            <input class="mybutton" name="deco" value="Deconnexion" type="submit"/>
                            </form>
                            <?php
                          }
                    }
    ?>
      </section>
        
    <?php

    } 
    else 
    {
        echo "Veuillez vous connecter pour accéder à votre page !";
    }

    ?>
    
    </main>

    <footer id= "foot_profil">
<nav class="navfoot">
            <a href="inscription.php">ACCUEIL</a>
            <a href="inscription.php">INSCRIPTION</a>
            <a href="connexion.php">CONNEXION</a>
            <a href="admin.php">ADMIN</a>
            <a id="colorf4" href="profil.php">PROFIL</a>
        </nav>
        <article>
            <p><b>Copyright 2019 Coding School | All Rights Reserved | Project by Alexandra REGGI.<b></p>
        </article>
    </footer>
    
</body>

</html>
            