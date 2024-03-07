<?php
    include "../../config/db.php";
    include "../../config/baseurl.php";

    if(isset($_POST["topic"], $_POST["newspic"], $_POST["description"]) && 
        strlen($_POST["topic"] > 0) &&
        strlen($_POST["newspic"] > 0) &&
        strlen($_POST["description"] > 0)
    ){
        $topic = $_POST["topic"];
        $description = $_POST["description"];
        $newspic = $_POST["newspic"];
        session_start();
        $user_id = $_SESSION["id"];

        date_default_timezone_set('Asia/Almaty');
        $date = date('d.m.20y');

        $prep = mysqli_prepare($con, "INSERT INTO news (topic, description, user_id, date, newspic) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($prep, "ssiss", $topic, $description, $user_id, $date, $newspic);
        mysqli_stmt_execute($prep);
        $username = $_SESSION["username"];
        header("Location:$BASE_URL/index.php?username=$username");
    }
    else{
        header("Location:$BASE_URL/adding.php?error=6");
    }