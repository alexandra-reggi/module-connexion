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
                <li><a id="color3" href= "connexion.php" >Connexion</a></li>
                <li><a href= "admin.php"> Profil</a></li>
                <li><a href= "profil.php"> Admin</a></li>
            </ul>
        </nav>

    </header>

    <main id= "main_profil">

    <section id="leftsidbar">

    <?php

    if (isset($SESSION['login']))
    {
        $connexion= myscli_connect("localhost", "root", "","moduleconnexion");
        $requete= "SELECT * FROM utilisateurs WHERE login= '". $_SESSION['login']."'";
        $query= mysqli_query($connexion, $requete);
        $resultat= myscli_fetch_assoc($query);
    ?>

        <form id="form_profil" action="profil.php" method="post">
            <label>Login</label>
            <input type="text" name="login" value=<?php echo $resultat['login'];?>/>
            <labe>Prenom</label>
            <input type="text"  name="prenom" value= <?php echo $resultat['prenom'];?>/>
            <label>Nom</label>
            <input type="text" name="nom" value= <?php $resultat['nom'];?>/>
            <input id="profil_ID" name="ID" type="hidden" value=<?php echo $resultat['id']; ?> />
            <input class="mybutton" type="submit" name="modifier" value="Modifier" />
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

         <section id="rightsidebar"> 
                 <form class="form_profil" action="profil.php" method="post">
                    <label> New Password </label>
                    <input type="password" name="passwordx" />
                    <label> Confirm New Password </label>
                    <input type="password" name="passwordconf" />
                    <input id="prodId" name="ID" type="hidden" value=<?php echo $resultat['id']; ?> />
                    <input class="mybutton" type="submit" name="modifier2" value="Modifier MDP" />
                </form>

         <?php 
                if (isset($_POST['modifier2'])) 
                    {
                       if ($_POST["passwordx"] != $_POST["passwordconf"]) 
                          {
                            echo "Attention ! Mot de passe différents";
                          } 
                       elseif(isset($_POST['passwordx']))
                       {
                            $pwdx = password_hash($_POST['passwordx'], PASSWORD_BCRYPT, array('cost' => 12));
                            $updatepwd = "UPDATE utilisateurs SET password = '$pwdx' WHERE id = '" . $resultat['id'] . "'";
                            $query2 = mysqli_query($connexion, $updatepwd);
                            header("Location:profil.php"); 
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
            <a id="colorf3" href="inscription.php">INSCRIPTION</a>
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
            