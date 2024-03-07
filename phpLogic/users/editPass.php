<?php
    include "../../config/db.php";
    include "../../config/baseurl.php";
    if(isset($_POST["email"],
        $_POST["username"],
        $_POST["password"],
        $_POST["password2"],) &&
        strlen($_POST["username"]) > 0 &&
        strlen($_POST["password"]) > 0 &&
        strlen($_POST["password2"]) > 0
    ){
        $email = $_POST["email"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $password2 = $_POST["password2"];
        $role = "Student";
        session_start();
        $user_id = $_SESSION["id"];

        if($password !== $password2){
            header("Location:$BASE_URL/changePass.php?error=2");
            exit();
        }

        $check_user = mysqli_query($con, "SELECT * FROM users WHERE username = '$username'");
        if(mysqli_num_rows($check_user) == 0){
            header("Location:$BASE_URL/changePass.php?error=8");
            exit();
        }
        $check = mysqli_fetch_assoc($check_user);
        if($check["email"] !== $email){
            header("Location:$BASE_URL/changePass.php?error=8");
            exit();
        }

        $hash = sha1($password);

        $prep = mysqli_prepare($con, "UPDATE users SET password = ? WHERE username = ?");
        mysqli_stmt_bind_param($prep, "ss", $hash, $username);
        mysqli_stmt_execute($prep);

        header("Location:$BASE_URL/login.php");
    }
    else{
        header("Location:$BASE_URL/changePass.php?error=1&id=$user_id");
    }