<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="styles/all.css">
    <?php 
		include "config/baseurl.php";
	?>
</head>
<body>
    <section class="register">
        <h1>Chess {Platform}</h1>
        <h2>Registration</h2>

        <form class="log-reg-form" action="phpLogic/users/signup.php" method="POST">
            <div class="form-element">
                <input type="text" name="email" placeholder="Email:">
                <input autocomplete="off" type="text" name="username" placeholder="Username:">
                <input autocomplete="off" type="password" name="password" placeholder="Password:">
                <input autocomplete="off" type="password" name="password2" placeholder="Password2:">
                <button class="send-btn" type="submit">Register</button>
            </div>
        </form>

        <?php 
        if(isset($_GET["error"]) && $_GET["error"] == 1){
        ?>
            <p style = "color:red; text-align:center;">Заполните все поля</p>
        <?php 
            }else if(isset($_GET["error"]) && $_GET["error"] == 2){
        ?>
            <p style = "color:red; text-align:center;">пароли не совпадают</p>

        <?php }else if(isset($_GET["error"]) && $_GET["error"] == 3){ ?>

            <p style = "color:red; text-align:center;">Такой пользователь уже существует</p>
                    
        <?php }else if(isset($_GET["error"]) && $_GET["error"] == 7){ ?>
            <p style = "color:red; text-align:center;">Пароль уязвимый, необхождимо минимально 8 симовлов с 1 заглавной буквой и 1 цифрой</p>
        <?php }?>

        <a class="acclog" href="<?=$BASE_URL?>/login.php">Already have an account? Log in</a>
    </section>
</body>
</html>