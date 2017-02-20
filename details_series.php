<?php
// details_series.php for index.php in /var/www/html/my_streaming
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
    <link rel="stylesheet" href="styles/details_film.css" />
    <link rel="stylesheet" href="styles/style.css" />
</head>
<?php include("header.php"); ?>
<article>
    <h1>Series</h1>
    <?php
    $n = 0;
    if (isset($_SESSION['ID']))
        $id_user = $_SESSION['ID'];
    $id = $_GET['id'];
    $aff = $co->prepare("SELECT * FROM Series WHERE id='$id'");
    $aff->execute();
    $result = $aff->fetchAll();
    $id_categorie = $result[$n][5];
    $aff_categorie = $co->prepare("SELECT libelle FROM Categories WHERE ID='$id_categorie'");
    $aff_categorie->execute();
    $result_categorie = $aff_categorie->fetchAll();
    $ID_series = $result[0][0];
    $get_note = $co->prepare("SELECT COUNT(Note) FROM Note WHERE ID_series='$ID_series'");
    $get_note->execute();
    $result_note = $get_note->fetch();
    $j = 0;
    $sum_note = $co->prepare("SELECT SUM(Note) FROM Note WHERE ID_series='$ID_series'");
    $sum_note->execute();
    $result_sum = $sum_note->fetch();
    $note_total = $result_sum[0];
    $nbr_notes = $result_note[0];
    $note_total = $note_total / $nbr_notes;
    $add_note = $co->prepare("UPDATE Series SET note = '$note_total' WHERE ID='$ID_series'");
    $add_note->execute();
    ?>
    <section>
        <div>
            <?php echo ' <img src="' . $result[0][4] . '"/>'; ?>
            <p>
            <div id="details_contain1"><?php echo $result[0][1];?> <br />
                <?php echo $result[0][2]; ?> <br />
                <?php echo $result[0][3]; ?> <br />
                <?php echo $result_categorie[0][0]; ?> <br />
                <?php echo 'Note: ' . $note_total . "/5"; ?> <br />
                <?php echo $result[0][6]; ?> <br /></div>
            <div id="details_synopsis"><?php echo $result[0][7]; ?> <br /></div>
            <?php
            if (isset($_SESSION['ID'])) {
                echo '<button><a href="playlist.php?id=' . $_SESSION['ID']. '&amp;id_series=' . $result[0][0] . '">Ajout Playlist</a></button>';
                echo '<button id="co"><a href="comment.php?id_series=' . $result[0][0] . '">Comment</a></button>';
                echo '<form action="" method="post">Donner une note :<input type="number" min="0" max="5" name="note"><p><input type="submit" name="Send" value="Send"/></p></form>';
                $note = $_POST['note'];
                $ID_series = $result[0][0];
                $note_exist = $co->prepare("SELECT * FROM Note WHERE ID_user='$id_user' AND ID_series='$ID_series'");
                $note_exist->execute();
                $result_exist = $note_exist->fetchAll();
                if (isset($result_exist[0][0]))
                    $send_note = $co->prepare("UPDATE Note SET Note='$note' WHERE ID_user='$id_user' AND ID_series='$ID_series'");
                else
                    $send_note = $co->prepare("INSERT INTO Note(Note, ID_user, ID_series) VALUES ('$note', '$id_user', '$ID_series');");
                if (isset($_POST['Send'])) {
                    $send_note->execute();
                    header("refresh:0.5; url=details_series.php?id=$ID_series");
                }
            }
            $n++;
            ?>
</article>
<section id="commentaire">
    <h2>Commentaires</h2>
    <?php
    $ID_series = $result[0][0];
    $aff_comment = $co->prepare("SELECT * FROM Commentaires WHERE ID_series='$ID_series'");
    $aff_comment->execute();
    $result_comment = $aff_comment->fetchAll();
    $i = 0;
    while ($result_comment[$i]){
        echo '<div class="commentaire_container" ><p>' . $result_comment[$i][5] . '</p>';
        echo '<p2 class="auteur"> Ecrit par : ' . $result_comment[$i][2] . '</p2></div>';
        $i++;
    }
    ?>
</section>
<footer>
    <?php  include("footer.php"); ?>
</footer>
</body>
</html>