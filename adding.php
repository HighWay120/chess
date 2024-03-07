<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adding</title>
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


    <h1 class="add">Fill forms to publish new materials</h1>

    <section class="adding">
        <div class="adding-btn">
            <h2 class="tag1 activeBtn">News form</h2>
            <h2 class="tag1">Video form</h2>
            <h2 class="tag1">Puzzle form</h2>
        </div>

        <div class="adding-inner active">
            <form action="phpLogic/news/add.php" method="POST" enctype="multipart/form-data" class="adding-form">
                <div class="form-element1">
                    <input autocomplete="off" type="text" name="topic" placeholder="Topic:" required>
                    <input autocomplete="off" type="text" name="newspic" placeholder="News image reference:" required>
                    <textarea name="description" id="" cols="90" rows="20" placeholder="Description" required></textarea>
                    <button class="send-btn" type="submit">Send</button>
                </div>
            </form>
        </div>

        <div class="adding-inner">
            <form action="phpLogic/lessons/add.php" method="POST" enctype="multipart/form-data" class="adding-form">
                <div class="form-element2">
                    <input autocomplete="off" type="text" name="name" placeholder="Name:" required>
                    <input autocomplete="off" type="text" name="video" placeholder="Video reference:" required>
                    <select name="category_id" id="">
                    <?php 
					    $categories = mysqli_query($con, "SELECT * FROM categories");
					    if(mysqli_num_rows($categories) > 0){
						    while($categ = mysqli_fetch_assoc($categories)){
				    ?>
						<option value="<?= $categ["id"]?>"><?= $categ["categ_name"] ?></option>
				    <?php 
						    }
					    }
				    ?>
                    </select>
                    <button class="send-btn" type="submit">Send</button>
                </div>
            </form>
        </div>

        <div class="adding-inner">
            <form action="phpLogic/puzzles/add.php" method="POST" enctype="multipart/form-data" class="adding-form">
                <div class="form-element3">
                    <input autocomplete="off" type="text" name="title" placeholder="Title:" required>
                    <input autocomplete="off" type="text" name="picture" placeholder="Picture reference:" required>
                    <textarea name="solution" id="" cols="70" rows="10" placeholder="Solution" required></textarea>
                    <select name="categ_id" id="">
                    <?php 
					    $categories = mysqli_query($con, "SELECT * FROM categories");
					    if(mysqli_num_rows($categories) > 0){
						    while($categ = mysqli_fetch_assoc($categories)){
				    ?>
						<option value="<?= $categ["id"]?>"><?= $categ["categ_name"] ?></option>
				    <?php 
						    }
					    }
				    ?>
                    </select>
                    <button class="send-btn" type="submit">Send</button>
                </div>
            </form>
        </div>

        <div class="notseen">
            <h2 class="activeBtn">News form</h2>
            <h2>Video form</h2>
            <h2>Puzzle form</h2>
        </div>
    </section>

    <?php
		if(isset($_GET["error"]) == 6){
	?>

	    <p style = "color:red; text-align:center;"> Заголовок и Описание не могут быть пустыми!</p>

	<?php } ?>

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

    <script src="js/navigation.js"></script>
</body>
</html>