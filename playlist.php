<?php
// playlist.php for index.php in /var/www/html/my_streaming
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
    <link rel="stylesheet" href="styles/playlist.css" />
    <link rel="stylesheet" href="styles/style.css" />
</head>
<?php include("header.php");
$id = $_SESSION['ID'];
if (isset($_GET['id']) && (isset($_GET['id_films']) || isset($_GET['id_series'])))
{
    $id_films = $_GET['id_films'];
    $id_user = $_GET['id'];
    $id_series = $_GET['id_series'];
    if (isset($id_films)) {
        $aff_playlist = $co->prepare("SELECT * FROM Playlist WHERE ID_utilisateur='$id' AND ID_films='$id_films'");
        $aff_playlist->execute();
        $result_playlist = $aff_playlist->fetchAll();
        if (!isset($result_playlist[0][0])) {
            $ajout = $co->prepare("INSERT INTO Playlist (ID_films, ID_utilisateur) VALUES
(
'$id_films',
'$id'
);"
            );
            $ajout->execute();
        }
    }
    if (isset($id_series)){
        $aff_playlist2 = $co->prepare("SELECT * FROM Playlist WHERE ID_utilisateur='$id' AND ID_series='$id_series'");
        $aff_playlist2->execute();
        $result_playlist2 = $aff_playlist2->fetchAll();
        if (!isset($result_playlist2[0][1])) {
            $ajout = $co->prepare("INSERT INTO Playlist (ID_series, ID_utilisateur) VALUES
(
'$id_series',
'$id'
);"
            );
            $ajout->execute();
        }
    }
}

?>
<article>
    <h1>Votre Playlist :</h1>
    <table border=1 cellspacing=4 cellpadding=4 width=80%>
        <tr>
            <th>Films/Serie</th>
            <th>Titre</th>
            <th>Annee</th>
        </tr>
        <?php
        $n = 0;
        $aff = $co->prepare("SELECT * FROM Films  JOIN (Playlist, Utilisateurs) ON (Utilisateurs.ID=Playlist.ID_utilisateur AND Films.ID=Playlist.ID_films) WHERE Playlist.ID_utilisateur='$id'");
        $aff->execute();
        $result = $aff->fetchAll();
        $aff2 = $co->prepare("SELECT * FROM Series JOIN (Playlist, Utilisateurs) ON (Utilisateurs.ID=Playlist.ID_utilisateur AND Series.ID=Playlist.ID_series) WHERE Playlist.ID_utilisateur='$id'");
        $aff2->execute();
        $result2 = $aff2->fetchAll();
        if (empty($result[0][0]) && empty($result2[0][0])) {
            ?> <p>Vous n avez pas ajouter de films ni de séries à votre playlist</p>
            <?php
        }
        elseif (empty($result[0][0]))
            echo '<p>' . "Vous n'avez pas ajouter de films dans votre playlist" . '</p>';
        elseif (empty($result2[0][0]))
            echo '<p>' . "Vous n'avez pas ajouter de séries dans votre playlist" . '</p>';
        if(isset($_GET['id_films']) || isset($_GET['id_series']))
            header("refresh:0.5; url=playlist.php?id=$id");
        while (isset($result[$n]))
        {
            $films = $result[$n][0];
            ?>
            <tr>
                <td><?php echo ' <img src="' . $result[$n]['Image'] . '"/>'; ?></td>
                <td><?php echo $result[$n][1];?></td>
                <td><?php echo $result[$n][3];?> </td>
                <td>  <?php echo '<button><a href="delete.php?id_films='.$films.'">Supprimer</a></button>'; ?></td>
            </tr>
            <?php
            $n++;
        }
        $i = 0;
        while (isset($result2[$i]))
        {
            ?>
            <tr>
                <td><?php echo ' <img src="' . $result2[$i][4] . '"/>'; ?></td>
                <td><?php echo $result2[$i][1];?></td>
                <td><?php echo $result2[$i][3];?> </td>
                <td>  <?php echo '<button><a href="delete.php?id='.$id.'&amp;id_series='.$result2[$i][0].'">Supprimer</a></button>'; ?></td>
            </tr>
            <?php
            $i++;
        }
        ?>
    </table>
</article>
<footer>
    <?php include("footer.php"); ?>
</footer>
</body>
</html>