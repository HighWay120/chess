<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChangePass</title>
    <link rel="stylesheet" href="styles/all.css">
    <?php 
		include "config/baseurl.php";
	?>
</head>
<body data-baseurl="<?= $BASE_URL?>">
    <section class="changePass">
        <h1>Chess {Platform}</h1>
        <h2>Changing password</h2>

        <form class="log-reg-form" action="phpLogic/users/editPass.php" enctype="multipart/form-data" method="POST">
            <div class="form-element">
                <input type="text" name="email" placeholder="Email:">
                <input type="text" name="username" placeholder="Username:">
                <input type="password" name="password" placeholder="New password:">
                <input type="password" name="password2" placeholder="Password Again:">
                <button class="send-btn" type="submit">Change</button>
            </div>
        </form>

        <?php 
            if(isset($_GET["error"]) && $_GET["error"] == 1){
        ?>
            <p style = "color:red;">Заполните все поля</p>
        <?php 
            }else if(isset($_GET["error"]) && $_GET["error"] == 2){
        ?>
            <p style = "color:red;">пароли не совпадают</p>

        <?php }else if(isset($_GET["error"]) && $_GET["error"] == 3){ ?>

            <p style = "color:red;">Такой пользователь уже существует</p>
                    
        <?php }else if(isset($_GET["error"]) && $_GET["error"] == 8){ ?>

            <p style = "color:red;">Неправильные данные</p>
        
        <?php } ?>

        <a class="acclog" href="">Already have an account? Log in</a>
    </section>
</body>
</html>