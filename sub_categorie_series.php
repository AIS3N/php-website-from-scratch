<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>DS STREAM</title>
    <link rel="stylesheet" href="styles/sub_categorie_films.css" />
    <link rel="stylesheet" href="styles/style.css" />
</head>
<?php include("header.php"); ?>
<article>
    <h1>Genre de séries<h1/>
        <br>
        <div id="series" class="sub_categorie">
            <a href="series.php?id_categorie=0"> <img src="images/series.png" alt="Series"></a>
            <h2>Afficher toutes les séries</h2>
        </div>
        <div id="action" class="sub_categorie">
            <a href="series.php?id_categorie=1"> <img src="images/action.jpg" alt="Action"> </a>
            <h2>Action</h2>
        </div>

        <div id="humour" class="sub_categorie">
            <a href="series.php?id_categorie=2"> <img src="images/humour.png" alt="Humour"></a>
            <h2>Humour</h2>
        </div>
        <div id="horreur" class="sub_categorie">
            <a href="series.php?id_categorie=3"> <img src="images/horreur.jpg" alt="Horreur"></a>
            <h2>Horreur</h2>
        </div>
        <div id="manga" class="sub_categorie">
            <a href="series.php?id_categorie=4"> <img src="images/manga.jpg" alt="Manga"></a>
            <h2>Manga</h2>
        </div>
        <div id="drame" class="sub_categorie">
            <a href="series.php?id_categorie=5"> <img src="images/drame.jpg" alt="Drame"></a>
            <h2>Drame</h2>
        </div>

</article>

<footer>
    <?php include("footer.php"); ?>
</footer>
</body>
</html>