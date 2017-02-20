<?php
// comment.php for index.php in /var/www/html/my_streaming
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
    <link rel="stylesheet" href="styles/add.css" />
    <link rel="stylesheet" href="styles/style.css" />
</head>
<?php include("header.php"); ?>
<article>
    <h1>Post Comment</h1>
    <div>
        <?php
        if (!empty($_POST['texte']))
        {
            $texte = htmlspecialchars($_POST['texte']);
            $auteur = $_SESSION['Pseudo'];
            $user = $_SESSION['ID'];
            if (!empty($_GET['id_films'])) {
                $id_films = $_GET['id_films'];
                $table = $co->prepare("INSERT INTO Commentaires (ID_user, Auteur,  ID_films, texte)
VALUES ('$user', '$auteur', '$id_films', '$texte')
");
                $table->execute();
                $tab = $table->fetch();
                header('Location: details_film.php?id=' . $id_films . '');
            }
            elseif (!empty($_GET['id_series'])){
                $id_series = $_GET['id_series'];
                $table = $co->prepare("INSERT INTO Commentaires (ID_user, Auteur,  ID_series, texte)
VALUES ('$user', '$auteur', '$id_series', '$texte')
");
                $table->execute();
                $tab = $table->fetch();
                header('Location: details_series.php?id=' . $id_series . '');
            }
        }
        ?>
        <form action="" method="post">
            <p><label><?php echo $_SESSION['Pseudo']; ?></label><br/></p>
            <p><label>Commentaire</label><br/>
                <textarea id="comment" name="texte"></textarea>
            </p>
            <p><input type="submit" value="Send"/></p>
        </form>
    </div>
</article>
<footer>
    <?php include("footer.php"); ?>
</footer>
</body>
</html>