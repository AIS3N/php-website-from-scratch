<?php
// categorie.php for index.php in /var/www/html/my_streaming
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
    <link rel="stylesheet" href="styles/categorie.css" />
    <link rel="stylesheet" href="styles/style.css" />
</head>
<?php include("header.php"); ?>
<article>
    <h1>Les categories<h1/>
        <br>
        <div id="films">
            <a href="sub_categorie_films.php"> <img src="images/films.jpg" alt="Films"> </a>
            <h2>Films</h2>
        </div>

        <div id="series">
            <a href="sub_categorie_series.php"> <img src="images/series.png" alt="Series"></a>
            <h2>Series</h2>
        </div>

</article>

<footer>
    <?php include("footer.php"); ?>
</footer>
</body>
</html>