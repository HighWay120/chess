<?php
	include "config/db.php";
	include "config/baseurl.php";
	$id_video = $_GET["id_video"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>videoDetail</title>
    <link rel="stylesheet" href="styles/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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

 <!-- 750/421.875 -->
    <div class="frame">
        <div class="frame-item">
            <?php
                $videos = mysqli_query($con, "SELECT v.* FROM videos v WHERE v.id = '$id_video'");
                $video =  mysqli_fetch_assoc($videos);
            ?>

            <iframe width="100%" height="421.875" src="<?=$video["video"]?>"
            title="YouTube video player" frameborder="0" 
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
            allowfullscreen></iframe>
            <div class="sub-frame">
                <p>Date: <?=$video["date"]?></p>
                <form action="phpLogic/lessons/edit.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_video" value="<?= $id_video?>"/> 
                    <button><i class="fa fa-check" aria-hidden="true" type="submit"></i> Viewed</button>
                </form>
            </div>
            <h1><?=$video["name"]?></h1>
        </div>
    </div>

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