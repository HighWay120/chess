<?php
	include "config/db.php";
	include "config/baseurl.php";
	$id_puzzle = $_GET["id_puzzle"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PuzzleDetail</title>
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

    <div class="wrapper">
        <input type="checkbox" id="radioYour Account" name="accordion" checked="checked"/>
        <label class="item" for="radioYour Account">
          <div class="title">Instruction to correctly insert answers of puzzles</div>
          <div class="accordion">
            <ul>
                <li>Пишите ответы следующим образом: 1. Kf2 Лd1 2. Лh3 и так далее..!</li>
                <li>Разрешается писать все буквы заглавными и (или) строчными!</li>
                <li>Обратите внимание, что название фигур (К, С, Л) пишутся русским алфавитом, а адрес полей (h1, d3) английским алфавито!</li>
                <li>Пишите аккуратно и внимательно!</li>
            </ul>
          </div>
        </label>
    </div>

    <div class="puzzles">
        <div class="puzzles-item">
            <?php
                $pictures = mysqli_query($con, "SELECT p.* FROM pictures p WHERE p.id = '$id_puzzle'");
                $picture =  mysqli_fetch_assoc($pictures);
            ?>

            <img src="<?=$picture["picture"]?>" alt="Not found">
            <div class="puzzles-group">
                <form class="puzzles-form" action="phpLogic/puzzles/edit.php" method="POST">
                        <input id="answer" type="text" name="answer" placeholder="Answer:" value=" ">
                        <input id="sol" type="hidden" name="solution" value="<?=$picture["solution"]?>"/> 
                        <input type="hidden" name="id_puzzle" value="<?=$id_puzzle?>"/> 
                        <button type="submit">Try out</button>
                </form>
                <button id="button">View the answer</button>
                <?php 
                if(isset($_GET["error"]) && $_GET["error"] == 6){
                ?>
                    <p style = "color:red; text-align:center;">Wrong answer!</p>
                <?php
                }else if(isset($_GET["state"]) && $_GET["state"] == 1){
                ?>
                    <p style = "color:blue; text-align:center;">Right answer!</p>
                <?php
                }
                ?> 
            </div>
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


    <script src="js/showSolution.js"></script>
</body>
</html>