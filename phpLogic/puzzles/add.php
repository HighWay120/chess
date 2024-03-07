<?php
    include "../../config/db.php";
    include "../../config/baseurl.php";

    if(isset($_POST["title"], $_POST["picture"], $_POST["solution"], $_POST["categ_id"]) &&
        strlen($_POST["title"] > 0) &&
        strlen($_POST["picture"] > 0) &&
        strlen($_POST["solution"] > 0) &&
        intval($_POST["categ_id"])
    ){
        $title = $_POST["title"];
        $picture = $_POST["picture"];
        $solution = $_POST["solution"];
        $categ_id = $_POST["categ_id"];
        session_start();
        $user_id = $_SESSION["id"];

        $prep = mysqli_prepare($con, "INSERT INTO pictures (title, picture, solution, categ_id) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($prep, "sssi", $title, $picture, $solution, $categ_id);
        mysqli_stmt_execute($prep);
        $nickname = $_SESSION["nickname"];
        header("Location:$BASE_URL/puzzles.php?nickname=$nickname");
    }
    else{
        header("Location:$BASE_URL/adding.php?error=6");
    }