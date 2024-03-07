<?php
    include "config/db.php";

    $sql = "SELECT p.*, c.categ_name FROM pictures p INNER JOIN categories c ON p.categ_id = c.id";

	$category = null;
	if(isset($_GET["category"]) && intval($_GET["category"])){
		$category = $_GET["category"];
		$sql.=" WHERE p.categ_id='$category'";
		$get_categories = mysqli_query($con, "SELECT * FROM categories WHERE id ='$category'");
		$categ = mysqli_fetch_assoc($get_categories);
	}

	$pictures = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Puzzles</title>
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

    <h1 class="welcome">Entered in <span id="outwel"></span> section!</h1>
    

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

    <section class="puzzle-ref">

        <?php 
            $id_user = $_SESSION["id"];
            $sqlView = "SELECT DISTINCT p.id FROM pictures p JOIN solvedpuzzles s ON p.id = s.id_puzzle WHERE s.id_user = '$id_user'";
            $puzzleViews = mysqli_query($con, $sqlView);

            $status = "";
            $puzarr = array();
            while($puzzleView = mysqli_fetch_assoc($puzzleViews)){
                array_push($puzarr, $puzzleView["id"]);
            }

		    if(mysqli_num_rows($pictures) > 0){
			    while($picture = mysqli_fetch_assoc($pictures)){
                    if(in_array($picture["id"], $puzarr)){
                        $status = "[Solved]";
                    }else{
                        $status = "";
                    }
		?>

        <a href="<?=$BASE_URL?>/puzzleDetail.php?id_puzzle=<?=$picture["id"]?>">Puzzle N<?=$picture["id"]?> <?=$status?></a>

        <?php 
			}
				}else{
		    ?>
			    <p style = "text-align:center; margin:0 auto;">There are no puzzles by this category :(</p>
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

    <script src="js/typewriter2.js"></script>
</body>
</html>