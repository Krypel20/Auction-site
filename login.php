<?php 
    require_once "includes/config_session.inc.php";
    require_once "includes/login_view.inc.php";
    
    if(isset($_SESSION['user_id'])){
        $time = new DateTime();
        $newtime = $time->Modify("+2 seconds");
        header("location:index.php");
    }
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Okno Logowania</title>
    <link rel="stylesheet" href="css/loginRegisterForm.css">
</head>
<body>
    <div class="login-container">
        <h3>
        </h3>
        <form action="includes/login.inc.php" class="login-form", method="post">
            <h1><?php output_username() ?></h1>
            <div class="input-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" placeholder="Twój e-mail" required>
            </div>
            <div class="input-group">
                <label for="password">Hasło</label>
                <input type="password" id="password" name="pwd" placeholder="Twoje hasło" required>
            </div>
            <?php 
                check_login_errors();
                if(!isset($_SESSION["user_id"])){
                    echo '<button type="submit">Zaloguj się</button>
                    <a href="#" class="reset-password">Zapomniałeś hasła?</a>
                    <a href="register.php" class="register-link">Zarejestruj się</a>';
                }
            ?>
    </div>
</body>
</html>
