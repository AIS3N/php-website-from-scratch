<?php
// header.php for index.php in /var/www/html/my_streaming
//
// Made by SMAJOVIC Demirel
// Login   <smajov_d@etna-alternance.net>
//
// Started on  Tue Jan 10 16:48:27 2017 SMAJOVIC Demirel
// Last update Tue Jan 10 16:48:39 2017 SMAJOVIC Demirel
//


try {
    $co = new PDO('mysql:host=localhost;dbname=my_streaming;charset=utf8', 'root', 'demi1509');
} catch (PDOException $e) {
    echo "Erreur lors de la connexion: " . $e-> getMessage();

}
?>
<body>
<a href="index.php"> <h1 id="titre">DS STREAM</h1></a>
<header>
    <div id="onglet_co">
        <p>
            <?php
            if (!empty($_SESSION['ID']))
            {
                echo $_SESSION['Pseudo'];
                $id = $_SESSION['ID'];
            }
            else
                echo "Non connecté";
            ?>
            <br />
            <?php
            if (isset($_SESSION['ID']))
                echo '<a href="deconnexion.php" <button>Deconnexion</button></a>';
            else
                echo '<a href="index.php" <button>Connexion</button></a>';
            ?>
        </p>
    </div>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="categorie.php">Categorie</a></li>
            <li><a href="register.php">Inscription</a></li>
        <?php
        if (isset($_SESSION['ID']) && $_SESSION['Role'] == '1')
            echo '<li><a href="admin.php">Admin</a></li>';
        else if (isset($_SESSION['ID']))
        {
            echo '<li><a href="playlist.php?id='.$_SESSION['ID'].'">Playlist</a><img href="playlist.php?id='.$_SESSION['ID'].'" src="images/playlist.png"></li>';
        }
        ?>
            <ul>
    </nav>
</header>