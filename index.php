<?php
    include "config/db.php";
    $limit = 3;

    $sql = "SELECT n.*, u.username FROM news n INNER JOIN users u ON n.user_id = u.id";
    $sql_count = "SELECT CEIL(COUNT(*) / '$limit') as total FROM news n INNER JOIN users u ON n.user_id = u.id";

    $search = null;
	if(isset($_GET["search"])){
		$search_query = $_GET["search"];
		// lower case
		$search = strtolower($_GET["search"]);
		$sql.=" WHERE LOWER(n.topic) LIKE '%$search%' OR LOWER(n.description) LIKE '%$search%' OR LOWER(u.username) LIKE '%$search%' OR 
        LOWER(n.date) LIKE '%$search%'";
		$sql_count.=" WHERE LOWER(n.topic) LIKE '%$search%' OR LOWER(n.description) LIKE '%$search%' OR LOWER(u.username) LIKE '%$search%'
        OR LOWER(n.date) LIKE '%$search%' ";
	}

    $page = 1;
	if(isset($_GET["page"]) && intval($_GET["page"])){
		$page = $_GET["page"];
		$skip = ($_GET["page"] - 1) * $limit;
		$sql.=" LIMIT $skip, $limit";
	}else{
		$sql.=" LIMIT $limit";
	}

    $news = mysqli_query($con, $sql);
    $counts = mysqli_query($con, $sql_count);
	$count = mysqli_fetch_assoc($counts);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chess_Main</title>
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

        <div class="searchGroup">
            <form class="search-container" action="<?= $BASE_URL?>/" method="GET">
                <input type="text" placeholder="Search..." name="search">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>

        <div class="head-btns"> 
            <a href="<?=$BASE_URL?>/video.php">Lessons</a>
            <a href="<?=$BASE_URL?>/puzzles.php">Puzzles</a>
            <a href="<?=$BASE_URL?>/phpLogic/users/signout.php">Log out</a>
        </div>
    </header>


    <section class="content">

        <div class="news">

            <?php 
		        if(mysqli_num_rows($news) > 0){
			        while($new = mysqli_fetch_assoc($news)){
		    ?>

            <div class="news-item">
                <img src="<?=$new["newspic"]?>" alt="Not found">
                <div class="news-info">
                    <p>Author: @<?=$new["username"]?></p>
                    <p>Date: <?=$new["date"]?></p>
                </div>
                <a href="<?=$BASE_URL?>/news.php?id=<?=$new["id"]?>"><?=$new["topic"]?></a>

                <?php
                    if($_SESSION["role"] == "Admin"){
                ?>
                <form action="phpLogic/news/delete.php" method="POST">
                    <input type="hidden" name="id_news" value="<?= $new["id"]?>"/> 
                    <button type="submit">Delete</button>
                </form>
                <?php
                    }
                ?>
            </div>

            <?php 
			}
				}else{
		    ?>
			    <h1 class="no-text">There are no news by this category :(</h1>
		    <?php } ?>
        </div>

        <div class="profile">
            <h1>Profile</h1>
            <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" alt="Not found">
            <h2>User:</h2>
            <p>@<?= $_COOKIE["User"]?></p>
            <h2>Solved puzzles:</h2>
            <?php
                $id = $_SESSION["id"];
                $sqlNum = "SELECT COUNT(DISTINCT p.id) AS count_puzzles FROM pictures p JOIN solvedpuzzles s ON p.id = s.id_puzzle WHERE s.id_user = '$id'";
                $puzzleNum = mysqli_query($con, $sqlNum);
                if ($puzzleNum->num_rows > 0) {
                    $row = $puzzleNum->fetch_assoc();
                    $countPuzzles = $row['count_puzzles'];
                } else {
                    echo "No puzzles found.";
                }
            ?>
            <p><span class="counter" data-num="<?= $countPuzzles?>">0</span></p>

            <h2>Watched videos:</h2>
            <?php
                $id = $_SESSION["id"];
                $sqlNum = "SELECT COUNT(DISTINCT v.id) AS count_videos FROM videos v JOIN watchedvideos w ON v.id = w.id_video WHERE w.id_user = '$id'";
                $videoNum = mysqli_query($con, $sqlNum);
                if ($videoNum->num_rows > 0) {
                    $row = $videoNum->fetch_assoc();
                    $countVideos = $row['count_videos'];
                } else {
                    echo "No matching videos found.";
                }
            ?>
            <p><span class="counter" data-num="<?= $countVideos?>">0</span></p>

            <?php
                if($_SESSION["role"] == "Admin"){
            ?>
            <a href="<?=$BASE_URL?>/adding.php" id="news">Add content</a>
            <?php
                }
            ?>
        </div>
    </section>

    <div class="pagination">

		<?php 
			for($i = 0; $i < $count["total"]; $i++){
		?>
            <a style="color: darkblue; display: inline-block; margin: 50px 10px 0 30px; padding: 5px; border: 2px solid #00A797; text-align: center; text-decoration: none;" 
            class="page-link page-<?=$i+1?>" href="<?=$BASE_URL?>/index.php?page=<?=$i+1?>"><?= $i + 1?></a>
		<?php 
			}
		?>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
    integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="js/counter.js"></script>
</body>
</html>