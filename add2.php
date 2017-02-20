<?php
// add2.php for index.php in /var/www/html/my_streaming
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
    <?php
    if ($_SESSION['ID'])
    { ?>
    <form method="post" action="add2.php">
        <h1>Ajouter une serie</h1>
        <input type="text" placeholder="Titre de la  serie" name="title">
        <input type="text" placeholder="Realisateur" name="realisateur">
        <input type="text" placeholder="Annee de parution" name="annee">
        <input type="text" placeholder="Fichier image (image.jpg)" name="image">
        <input type="text" placeholder="Nombre de saisons" name="duree">
        <textarea id="synopsis" placeholder="Synopsis" name="synopsis"></textarea>
        <select name="categorie">
            <option value="1" >Action</option>
            <option value="2">Humour</option>
            <option value="3">Horreur</option>
            <option value="4">Manga</option>
            <option value="5">Drame</option>
        </select>
        <br />
        <input type="submit">
        <?php }
        $erreur = 0;
        if (isset($_POST['title']))
        {
            $title = htmlspecialchars($_POST['title']);
            $realisateur = htmlspecialchars($_POST['realisateur']);
            $annee = htmlspecialchars($_POST['annee']);
            $image = htmlspecialchars($_POST['image']);
            $duree = htmlspecialchars($_POST['duree']);
            $synopsis = htmlspecialchars($_POST['synopsis']);
            $categorie = $_POST['categorie'];
            if (!preg_match("/^[\w-_.,\s]*$/", $title) || empty($title))
            {
                echo '<p>' . "Le titre n'est pas correct : " . '</p>';
                $erreur = 1;
            }
            if (!preg_match("/^[\w-_.,\s]*$/", $realisateur) || empty($realisateur))
            {
                echo '<p>' . "Le nom du réalisateur n'est pas correct : " . '</p>';
                $erreur = 1;
            }
            if (!preg_match("/^[0-9]{4}$/", $annee))
            {
                echo '<p>' . "L'année n'est pas correcte : " . '</p>';
                $erreur = 1;
            }
            if (!preg_match("/^[\w\s0-9]*$/", $duree) || empty($duree))
            {
                echo '<p>' . "Le nombre de saisons n'est pas correct : " . '</p>';
                $erreur = 1;
            }
            if (!preg_match("/^[\w_]*[.]{1}[a-z]{3,4}$/", $image))
            {
                echo '<p>' . "Le fichier image n'est pas correct :" . '</p>';
                $erreur = 1;
            }
            if (empty($synopsis))
            {
                echo '<p>' . "Le synopsis est vide" . '</p>';
                $erreur = 1;
            }
            if ($erreur == 0)
            {
                $add = $co->prepare("INSERT INTO Series (Titre, Realisateur, Annee, Image, Categorie, Saisons, Synopsis) VALUES 
(
'$title',
'$realisateur',
'$annee',
'images/$image',
'$categorie',
'$duree',
'$synopsis'
);");
                $add->execute();
            }
            else
                echo " Veuillez Ressayer";
        }
        ?>
    </form>
</article>
<footer>
    <?php include("footer.php"); ?>
</footer>
</body>
</html>