<?php
    include "../../config/db.php";
    include "../../config/baseurl.php";

    if(isset($_POST["id_video"]))
    {
        $id_video = $_POST["id_video"];
        session_start();
        $id_user = $_SESSION["id"];

        $prep = mysqli_prepare($con, "INSERT INTO watchedvideos (id_video, id_user) VALUES (?, ?)");
        mysqli_stmt_bind_param($prep, "ii", $id_video, $id_user);
        mysqli_stmt_execute($prep);
        $username = $_SESSION["username"];
        header("Location:$BASE_URL/videoDetail.php?id_video=$id_video");
    }
    else{
        header("Location:$BASE_URL/videoDetail.php?id_video=$id_video&error=6");
    }