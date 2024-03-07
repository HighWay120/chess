<?php
    include "../../config/baseurl.php";
    session_start();
    setcookie("User", "", time() - 3600);
    session_destroy();
    header("Location:$BASE_URL/login.php");