<?php
    include "config/db.php";

    $sql = "SELECT v.*, c.categ_name FROM videos v INNER JOIN categories c ON v.category_id = c.id";

	$category = null;
	if(isset($_GET["category"]) && intval($_GET["category"])){
		$category = $_GET["category"];
		$sql.=" WHERE v.category_id='$category'";
		$get_categories = mysqli_query($con, "SELECT * FROM categories WHERE id ='$category'");
		$categ = mysqli_fetch_assoc($get_categories);
	}

	$videos = mysqli_query($con, $sql);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video</title>
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

    <h1 class="welcome">Entered in <span id="outwel1"></span> section!</h1>

    <section class="video-btns">
        <?php 
            $categories = mysqli_query($con, "SELECT * FROM categories");
            if(mysqli_num_rows($categories) > 0){
                while($categ = mysqli_fetch_assoc($categories)){
        ?>
        <a id="razryad<?= $categ["id"]?>" href="<?=$BASE_URL?>/video.php?category=<?=$categ["id"]?>""><?= $categ["categ_name"]?></a>
        <?php 
				}
			}
		?>
        <a id="razryad8" href="<?=$BASE_URL?>/video.php">All</a>
    </section>

    <section class="video-ref">

        <?php 
            $id_user = $_SESSION["id"];
            $sqlView = "SELECT DISTINCT v.id FROM videos v JOIN watchedvideos w ON v.id = w.id_video WHERE w.id_user = '$id_user'";
            $videoViews = mysqli_query($con, $sqlView);

            $status = "";
            $vidarr = array();
            while($videoView = mysqli_fetch_assoc($videoViews)){
                array_push($vidarr, $videoView["id"]);
            }
		    if(mysqli_num_rows($videos) > 0){
			    while($video = mysqli_fetch_assoc($videos)){
                    if(in_array($video["id"], $vidarr)){
                        $status = "[Viewed]";
                    }else{
                        $status = "";
                    }
		?>

        <a href="<?=$BASE_URL?>/videoDetail.php?id_video=<?=$video["id"]?>">Lesson <?=$video["id"]?> <?=$status?></a>

        <?php 
			}
				}else{
		    ?>
			    <p style = "text-align:center; margin:0 auto;">There are no videos by this category :(</p>
		<?php } ?>
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

    <script src="js/typewriter1.js"></script>
</body>
</html>