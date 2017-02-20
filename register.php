<?php

session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>DS STREAM</title>
    <link rel="stylesheet" href="styles/register.css" />
    <link rel="stylesheet" href="styles/style.css" />
</head>
<?php include("header.php"); ?>
<article>
    <?php
    if (empty($_SESSION['ID']))
    { ?>
    <form method="post" action="register.php">
        <h1>Inscrivez-vous !</h1>
        <input type="text" placeholder="Votre nom" name="nom">
        <input type="text" placeholder="Votre Prénom" name="prenom">
        <input type="text" placeholder="Pseudo" name="pseudo">
        <input type="password" placeholder="Mot de passe" name="password">
        <input type="password" placeholder="Confirmez mot de passe" name="password2">
        <input type="mail" placeholder="email@gmail.com" name="mail">
        <input type="text" placeholder="1998-09-15" name="date_naissance" >
        <select name="pays">
            <option value="France" selected="selected">France </option>
            <option value="Belgique">Belgique</option>
            <option value="Suisse">Suisse</option>
            <option value="Allemagne">Allemagne </option>
            <option value="Angleterre">Angleterre </option>
            <option value="Espagne">Espagne </option>
            <option value="Italie">Italie </option>
            <option value="Croatie">Croatie </option>
            <option value="Luxembourg">Luxembourg </option>
        </select>
        <input type="radio"  name="sexe" value="H"> M
        <input type="radio"  name="sexe" value="F"> F
        <br>
        <label>
            <input class="form" type="checkbox" name="condition" /> J'accepte les Conditions d'utilisations.
        </label>
        <br>
        <label>
            <input class="form" type="checkbox"/>Je souhaite recevoir la newsletter Smartcom.<br />
            <br /> <input type="submit">
        </label>
        <?php }
        else {
            echo '<div id="already"><p>' . "Vous êtes déjà  inscrit !" . '</p></div>';
        }

        $erreur = 0;
        if (isset($_POST['nom']))
        {
            $nom = htmlspecialchars($_POST['nom']);
            $prenom = htmlspecialchars($_POST['prenom']);
            $pseudo = htmlspecialchars($_POST['pseudo']);
            $password = md5($_POST['password']);
            $password2 = md5($_POST['password2']);
            $mail = htmlspecialchars($_POST['mail']);
            $pays = htmlspecialchars($_POST['pays']);
            if (isset($_POST['sexe']))
                $sexe = $_POST['sexe'];
            $date_naissance = $_POST['date_naissance'];

            if (isset($_POST['condition']))
                $condition = $_POST['condition'];

            if(empty($condition))
            {
                echo '<p>' . "Veuillez accepter les conditions d'utilisations" . '</p>';
                $erreur = 1;
            }
            if (!preg_match("/^[\w-_.]*$/", $pseudo))
            {
                echo '<p>' . "Le Pseudo n'est pas correct : " . '</p>';
                $erreur = 1;
            }
            if (!preg_match("/[\w.-]*@[\w-]*[.][\w]*/", $mail))
            {
                echo '<p>' . "L'email n'est pas correcte : " . '</p>';
                $erreur = 1;
            }
            if (!preg_match("/^[a-zA-Z][a-z]*$/", $nom))
            {
                echo '<p>' . "Le nom n'est pas correcte : " . '</p>';
                $erreur = 1;
            }
            if (!preg_match("/^[a-zA-Z][a-z]*$/", $prenom))
            {
                echo '<p>' . "Le prenom  n'est pas correcte : " . '</p>';
                $erreur = 1;
            }
            if ($password != $password2)
            {
                echo '<p>' . "Les mots des passes ne sont pas identiques : " . '</p>';
                $erreur = 1;
            }
            if (!preg_match("/^([0-9]{4})[-]+([0-1][0-9])[-]+([0-3][0-9])$/", $date_naissance, $out))
            {
                echo '<p>' . "Le format de la date de naissance n'est pas valide : " . '</p>';
                $erreur = 1;
            }
            if (preg_match("/^([0-9]{4})[-]+([0-1][0-9])[-]+([0-3][0-9])$/", $date_naissance, $out))
            {
                if ($out[1] > 2016 || $out[2] > 12 || $out[3] > 31)
                {
                    echo '<p>' . "La date n'existe pas" . '</p>';
                    $erreur = 1;
                }
            }

            if ($erreur == 0)
            {
                $register = $co->prepare(" INSERT INTO Utilisateurs (
Nom, Prenom, Pseudo, Password, Date_de_naissance,  Mail, Pays, Sexe
, Date_creation) 
VALUES (
   '$nom',
   '$prenom',
   '$pseudo',
   '$password',
   '$date_naissance',
   '$mail',
   '$pays',
   '$sexe',
    CURDATE()
); ");
                $register->execute();
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