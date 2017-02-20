<?php
// index.php for index.php in /var/www/html/my_streaming
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
    <link rel="stylesheet" href="styles/index.css" />
    <link rel="stylesheet" href="styles/style.css" />
</head>
<?php include("header.php"); ?>
<aside>
    <?php if (!isset($_SESSION['ID']))
    { ?>
        <div id="co">
        <h1>Co<span>nnexi</span>on</h1><p>
        <form method="post" action="index.php" >
        <input type="text" name="Pseudo" placeholder="Ex: Pseudo05" /> <br />
        <input type="password" name="Password" /> <br />
        <input type="submit" value="Send" />
        <li><a href="register.php">Pas encore inscrit ? Cliquez ici</a></li>
        <?php
    }
    else
    { ?>
        <div id="user_co">
        <p>Bonjour et bienvenue sur DS STREAM, le 1er site de streaming francais. <br />
            Je vous invite a cliquer sur l'un des deux boutons ci dessous afin de consulter nos films et series.</p>
        <a href="films.php"><button>Films</button></a>
        <a href="series.php"><button>Series</button></a>
        </div>
        <?php
    }
    if (isset($_POST['Pseudo']))
    {
        $Pseudo = htmlspecialchars($_POST['Pseudo']);
        $Password = htmlspecialchars($_POST['Password']);
        $verif = $co->prepare('SELECT * FROM Utilisateurs WHERE Pseudo=? AND Password=?');
        $verif->bindParam(1, $Pseudo);
        $verif->bindParam(2, md5($Password));
        $verif->execute();
        $result = $verif->fetch();
        if ($result['Pseudo'] && $result['Password'])
        {
            echo "Vous etes connecte";
            $_SESSION['ID'] = $result['ID'];
            $_SESSION['Pseudo'] = $result['Pseudo'];
            $_SESSION['Role']= $result['Role'];
            header("Location: index.php");
        }
        else
            echo "Erreur impossible de se connecter";
    }
    ?>
    </p>
    </form>
    </div>
    <div id="reseau">
        <h1>Ret<span>rouvez-</span>Nous</h1>
        <img id="fb" src="images/fb.png" />
        <img id="twitter" src="images/twitter.png" />
        <img id="gmail" src="images/gmail.png" />
    </div>
</aside>
<section>
    <article id="last_films">
        <h2>Les derniers films ajoutés</h2>
        <?php
        $last_films = $co->prepare("SELECT * FROM Films ORDER BY ID DESC LIMIT 3");
        $last_films->execute();
        $result = $last_films->fetchAll();
        $n = 0;
        while (isset($result[$n]))
        {
        ?>
        <div>
            <?php echo ' <img src="' . $result[$n][4] . '"/>'; ?>
            <p>
                <?php echo $result[$n][1];?> <br />
                <?php echo $result[$n][2]; ?> <br />
                <?php echo $result[$n][3]; ?> <br />
                <?php echo $result[$n][6]; ?> <br />
                <?php echo '<button><a href="details_film.php?id='.$result[$n][0].'">Voir le Details</a></button>'; ?><br />
                <?php
                if (isset($_SESSION['ID']))
                    echo '<button><a href="playlist.php?id='.$_SESSION['ID'].'&amp;id_films='.$result[$n][0].'">Ajout Playlist</a></button>';
                $n++;
                }
                ?>
    </article>
    <article id="best_films">
        <h2>Les meilleurs films</h2>
        <?php
            $best_films = $co->prepare("SELECT * FROM Films ORDER BY Note DESC LIMIT 3");
            $best_films->execute();
            $result2 = $best_films->fetchAll();
            $i = 0;
        while (isset($result[$i]))
        {
        ?>
        <div>
            <?php echo ' <img src="' . $result[$i][4] . '"/>'; ?>
            <p>
                <?php echo $result[$i][1];?> <br />
                <?php echo "Note: " . $result[$i][8] . "/5"; ?> <br />
                <?php echo $result[$i][3]; ?> <br />
                <?php echo $result[$i][6]; ?> <br />
                <?php echo '<button><a href="details_film.php?id='.$result[$i][0].'">Voir le Details</a></button>'; ?><br />
                <?php
                if (isset($_SESSION['ID']))
                    echo '<button><a href="playlist.php?id='.$_SESSION['ID'].'&amp;id_films='.$result[$i][0].'">Ajout Playlist</a></button>';
                $i++;
                }
                ?>
    </article>
</section>
<footer>
    <?php include("footer.php"); ?>
</footer>
</body>
</html>