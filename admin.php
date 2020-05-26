<?php session_start();

$cnx = mysqli_connect("localhost", "root", "", "moduleconnexion");
$requete1 = "SELECT * FROM utilisateurs";
$query1 = mysqli_query($cnx, $requete1);
$resultat = mysqli_fetch_all($query1, MYSQLI_ASSOC);
mysqli_close($cnx);

?>

<!DOCTYPE html>

<html>

<head>
    <title>Module-connexion/Admin</title>
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
                <li><a href= "profil.php"> Profil</a></li>
                <li><a id="color5" href= "admin.php"> Admin</a></li>
            </ul>
        </nav>

    </header>

    <main id= "main_admin">

        <section>

        <?php

$i = 0;
if (!empty($_SESSION['login'])) 
{
  if ($_SESSION['login'] == "admin") 
  {
    echo "<table border>";
    echo "<thead><tr>";
    $taille = sizeof($resultat) - 1;
    foreach ($resultat[$taille] as $key => $value) 
    {
      echo "<th>{$key}</th>";
    }
    echo "</tr></thead>";
    echo "<tbody>";
    while ($i <= $taille) 
    {
      echo "<tr>";
      foreach ($resultat[$i] as $key => $value) 
      {
        echo "<td>{$value}</td>";
      }
      echo "</tr>";
      $i++;
    }

    echo "</tbody></table>";
  } 
  else 
  {
    echo "Vous n'avez pas accès à cette page.";
  }
} 
else 
{
  echo "Vous n'êtes pas connecté.";
}

?>

</section>


















    </main>

    <footer id= "foot_admin">
<nav class="navfoot">
            <a href="inscription.php">ACCUEIL</a>
            <a href="inscription.php">INSCRIPTION</a>
            <a href="connexion.php">CONNEXION</a>
            <a id="colorf5" href="admin.php">ADMIN</a>
            <a href="profil.php">PROFIL</a>
        </nav>
        <article>
            <p><b>Copyright 2019 Coding School | All Rights Reserved | Project by Alexandra REGGI.<b></p>
        </article>
    </footer>
    
</body>

</html>