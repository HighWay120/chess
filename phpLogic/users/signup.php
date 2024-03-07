<?php
    include "../../config/baseurl.php";
    include "../../config/db.php";

    if(
        isset($_POST["email"]) && strlen($_POST["email"]) > 0 &&
        isset($_POST["username"]) && strlen($_POST["username"]) > 0 &&
        isset($_POST["password"]) && strlen($_POST["password"]) > 0 &&
        isset($_POST["password2"]) && strlen($_POST["password2"]) > 0
    ){
        $email = $_POST["email"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $password2 = $_POST["password2"];
        $role = "Student";
    
        if($password !== $password2){
            header("Location:$BASE_URL/registration.php?error=2");
            exit();
        }

        $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/';
        if (preg_match($pattern, $password)) { 
        } else { 
            header("Location:$BASE_URL/registration.php?error=7");
            exit();
        } 

        $check_user = mysqli_query($con, "SELECT * FROM users WHERE username = '$username'");
        if(mysqli_num_rows($check_user) == 1){
            header("Location:$BASE_URL/registration.php?error=3");
            exit();
        }
        
        //  sha1 хэширование
        $hash = sha1($password);

        
    
        mysqli_query($con, "INSERT INTO users (email, username, password, role) VALUES ('$email', '$username', '$hash', '$role') "); 
        header("Location:$BASE_URL/login.php");
    }else{
        header("Location:$BASE_URL/registration.php?error=1");
        exit();
    }