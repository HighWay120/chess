<?php
    include "../../config/baseurl.php";
    include "../../config/db.php";

    if(
        isset($_POST["username"]) && strlen($_POST["username"]) > 0 &&
        isset($_POST["password"]) && strlen($_POST["password"]) > 0
    ){
        $username = $_POST["username"];
        $password = $_POST["password"];
        $check_user = mysqli_query($con, "SELECT * FROM users WHERE username = '$username'");
        if(mysqli_num_rows($check_user) == 0){
            header("Location:$BASE_URL/login.php?error=5");
            exit();
        }
        $hash = sha1($password);
        $user = mysqli_fetch_assoc($check_user);
        if($hash != $user["password"]){
            header("Location:$BASE_URL/login.php?error=5");
            exit();
        }
        session_start();
        $_SESSION["username"] = $user["username"];
        $_SESSION["id"] = $user["id"];
        $_SESSION["role"] = $user["role"];

        $cookie_name = "User";
        $cookie_value = $_SESSION["username"];
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 1 day
        header("Location:$BASE_URL/index.php?username=".$user["username"]);
    }else{
        header("Location:$BASE_URL/login.php?error=4");
        exit();
    }