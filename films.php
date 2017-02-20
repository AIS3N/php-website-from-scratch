<?php
// films.php for index.php in /var/www/html/my_streaming
//
// Made by SMAJOVIC Demirel
// Login   <smajov_d@etna-alternance.net>
//
// Started on  Tue Jan 10 16:48:27 2017 SMAJOVIC Demirel
// Last update Tue Jan 10 16:48:39 2017 SMAJOVIC Demirel
//


session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>DS STREAM</title>
    <link rel="stylesheet" href="styles/films.css" />
    <link rel="stylesheet" href="styles/style.css" />
</head>
<?php include("header.php"); ?>
<article>
    <h1>Films</h1>
    <?php
    $n = 0;
    if (isset($_SESSION['ID']))
        $id_user = $_SESSION['ID'];
    $id_categorie = $_GET['id_categorie'];
    if ($id_categorie != 0)
        $aff = $co->prepare("SELECT * FROM Films WHERE Categorie='$id_categorie'");
    else
        $aff = $co->prepare("SELECT * FROM Films");
    $aff->execute();
    $result = $aff->fetchAll();
    while (isset($result[$n]))
    {
    $id_categorie = $result[$n][5];
    $aff_categorie = $co->prepare("SELECT libelle FROM Categories WHERE ID='$id_categorie'");
    $aff_categorie->execute();
    $result_categorie = $aff_categorie->fetchAll();
    ?>
    <section>
        <div>
            <?php echo ' <img src="' . $result[$n][4] . '"/>'; ?>
            <p>
                <?php echo $result[$n][1];?> <br />
                <?php echo $result[$n][2]; ?> <br />
                <?php echo $result[$n][3]; ?> <br />
                <?php echo $result_categorie[$n][0]; ?> <br />
                <?php echo $result[$n][6]; ?> <br />
                <?php echo '<button><a href="details_film.php?id='.$result[$n][0].'">Voir le Details</a></button>'; ?><br />
                <?php
                if (isset($_SESSION['ID']))
                    echo '<button><a href="playlist.php?id='.$_SESSION['ID'].'&amp;id_films='.$result[$n][0].'">Ajout Playlist</a></button>';
                $n++;
                }
                ?>
</article>
<footer>
    <?php  include("footer.php"); ?>
</footer>
</body>
</html>