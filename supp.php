<?php
// supp.php for index.php in /var/www/html/my_streaming
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
$id = htmlspecialchars($_GET['id']);
$ID_films = htmlspecialchars($_GET['ID_films']);
$table = $co->prepare("DELETE FROM Commentaires WHERE ID='$id'");
$table->execute();
header('Location: details_film.php?id='.$ID_films.'');
?>