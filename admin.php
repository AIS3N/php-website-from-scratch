<?php
// admin.php for index.php in /var/www/html/my_streaming
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
<?php include("header.php"); ?>
<article>
    <?php
    $info_user = $co->prepare("SELECT * FROM Utilisateurs");
    $info_user->execute();
    $result_info = $info_user->fetchAll();
    ?>
    <table border=1 cellspacing=4 cellpadding=4 >
        <tr>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Pseudo</th>
            <th>Action</th>
        </tr>
        <?php
        $n = 0;
        while (isset($result_info[$n]))
        { ?>
            <tr>
                <td><?php echo $result_info[$n][2]; ?></td>
                <td><?php echo $result_info[$n][3]; ?></td>
                <td><?php echo $result_info[$n][4]; ?></td>
                <td><?php echo '<button><a href="delete_user.php?id='.$result_info[$n][0].'">Supprimer</a></button>'; ?></td>
            </tr>
            <?php $n++; } ?>
    </table>
</article>
<div id="add">
    <button><a href="add.php"> Ajouter un film</a></button>
    <button><a href="add2.php"> Ajouter une serie</a></button>
</div>
<footer>
    <?php include("footer.php"); ?>
</footer>
</body>
</html>