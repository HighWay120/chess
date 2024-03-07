<?php
    include "../../config/db.php";
    include "../../config/baseurl.php";

    session_start();
    $id_news = $_POST["id_news"];
    mysqli_query($con, "DELETE FROM news WHERE id='$id_news'");
    header("Location:$BASE_URL/index.php?username=".$_SESSION["username"]);