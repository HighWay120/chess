<?php
	include "config/db.php";
	include "config/baseurl.php";
	$id = $_GET["id"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News</title>
    <link rel="stylesheet" href="styles/all.css">

    <?php 
		include "config/baseurl.php";
	?>
</head>
<body data-baseurl="<?= $BASE_URL?>">
    <?php 
        include "config/baseurl.php";
        include "config/db.php";
        session_start();
    ?>

    <header class="header">
        <a href="<?=$BASE_URL?>/index.php">Chess {Platform}</a>
        <div class="head-btns"> 
            <a href="<?=$BASE_URL?>/video.php">Lessons</a>
            <a href="<?=$BASE_URL?>/puzzles.php">Puzzles</a>
            <a href="<?=$BASE_URL?>/phpLogic/users/signout.php">Log out</a>
        </div>
    </header>

    <section class="details">
        <?php
                $news = mysqli_query($con, "SELECT n.*, u.username FROM news n INNER JOIN users u ON n.user_id = u.id WHERE n.id = '$id'");
                $new =  mysqli_fetch_assoc($news);
        ?>

        <img src="<?=$new["newspic"]?>" alt="Not found">
        <h1><?=$new["topic"]?></h1>
        <div class="author-info">
            <h2>Author: @<?=$new["username"]?></h2>
            <h2>Date: <?=$new["date"]?></h2>
        </div>

        <p><?=$new["description"]?></p>

    </section>

    <footer class="footer">
        <h1>Chess_{Platform}</h1>
        <h2>Contacts:</h2>
        <div class="contacts">
            <p>+7 702 999 3077</p>
            <p>+7 702 999 3077</p>
            <p>+7 702 999 3077</p>
        </div>
        <p>All rights reserved.</p>
    </footer>
</body>
</html>