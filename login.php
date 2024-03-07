<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles/all.css">
    <?php 
		include "config/baseurl.php";
	?>
</head>
<body>

    <div class="alert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        Please, log in now!
    </div>

    <section class="login">
        <h1>Chess {Platform}</h1>
        <h2>Log in form</h2>

        <form class="log-reg-form" action="phpLogic/users/signin.php" method="POST">
            <div class="form-element">
                <input autocomplete="off" type="text" name="username" placeholder="Username:">
                <input autocomplete="off" type="text" name="password" placeholder="Password:">
                <button class="send-btn" type="submit">Log in</button>
            </div>
        </form>

        <?php 
        if(isset($_GET["error"]) && $_GET["error"] == 4){
        ?>
            <p style = "color:red; text-align:center;">Заполните все поля</p>
        <?php 
            }else if(isset($_GET["error"]) && $_GET["error"] == 5){
        ?>
            <p style = "color:red; text-align:center;">Неправильный логин или пароль</p>
        <?php } ?>

        <a class="newpass" href="<?=$BASE_URL?>/changePass.php">Forgot password?</a>
        <a class="newpass" href="<?=$BASE_URL?>/registration.php">Register</a>
    </section>
</body>
</html>