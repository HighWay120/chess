<?php
    include "../../config/db.php";
    include "../../config/baseurl.php";

    if(isset($_POST["name"], $_POST["video"], $_POST["category_id"]) &&
        strlen($_POST["name"] > 0) &&
        strlen($_POST["video"] > 0) &&
        intval($_POST["category_id"])
    ){
        $name = $_POST["name"];
        $video = $_POST["video"];
        $category_id = $_POST["category_id"];
        session_start();
        $user_id = $_SESSION["id"];
        $status = "";

        date_default_timezone_set('Asia/Almaty');
        $date = date('d.m.20y');

        $prep = mysqli_prepare($con, "INSERT INTO videos (name, video, category_id, date, status) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($prep, "ssiss", $name, $video, $category_id, $date, $status);
        mysqli_stmt_execute($prep);
        $username = $_SESSION["username"];
        header("Location:$BASE_URL/video.php?username=$username");
    }
    else{
        header("Location:$BASE_URL/adding.php?error=6");
    }