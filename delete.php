<?php
// delete.php for index.php in /var/www/html/my_streaming
//
// Made by SMAJOVIC Demirel
// Login   <smajov_d@etna-alternance.net>
//
// Started on  Tue Jan 10 16:48:27 2017 SMAJOVIC Demirel
// Last update Tue Jan 10 16:48:39 2017 SMAJOVIC Demirel
//


session_start();
try {
    $co = new PDO('mysql:host=localhost;dbname=my_streaming;charset=utf8', 'root', 'demi1509');
} catch (PDOException $e) {
    echo "Erreur lors de la connexion: " . $e-> getMessage();

}
$id_films = htmlspecialchars($_GET['id_films']);
$id_series = htmlspecialchars($_GET['id_series']);
$id = $_SESSION['ID'];
if (isset($id_films)) {
    $delete = $co->prepare("DELETE FROM Playlist WHERE ID_utilisateur='$id' AND ID_films='$id_films'");
    $delete->execute();
}
if (isset($id_series)) {
    $delete = $co->prepare("DELETE FROM Playlist WHERE ID_utilisateur='$id' AND ID_series='$id_series'");
    $delete->execute();
}
header("Location: playlist.php?id=$id");