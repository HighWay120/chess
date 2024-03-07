<?php
    include "../../config/baseurl.php";
    include "../../config/db.php";

    if(
        isset($_POST["answer"]) && strlen($_POST["answer"]) > 0 && isset($_POST["id_puzzle"])
    ){
        $answer = $_POST["answer"];
        $id_puzzle = $_POST["id_puzzle"];
        $check_picture = mysqli_query($con, "SELECT * FROM pictures WHERE id = '$id_puzzle'");
        if(mysqli_num_rows($check_picture) == 0){
            header("Location:$BASE_URL/puzzleDetail.php?id_puzzle=$id_puzzle&error=5");
            exit();
        }
        $picture = mysqli_fetch_assoc($check_picture);
        $solChanged = preg_replace('/\s+/', '', $picture["solution"]);
        $answer = preg_replace('/\s+/', '', $answer);
        if(mb_strtolower($answer) != mb_strtolower($solChanged)){
            header("Location:$BASE_URL/puzzleDetail.php?id_puzzle=$id_puzzle&error=6");
            exit();
        }
        session_start();
        $id_user = $_SESSION["id"];

        $prep = mysqli_prepare($con, "INSERT INTO solvedpuzzles (id_puzzle, id_user) VALUES (?, ?)");
        mysqli_stmt_bind_param($prep, "ii", $id_puzzle, $id_user);
        mysqli_stmt_execute($prep);
        header("Location:$BASE_URL/puzzleDetail.php?id_puzzle=$id_puzzle&state=1");
    }else{
        header("Location:$BASE_URL/puzzleDetail.php?id_puzzle=$id_puzzle&error=4");
        exit();
    }