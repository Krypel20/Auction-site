<?php 
    require_once "includes/config_session.inc.php";
    require_once "includes/login_view.inc.php";
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
        <form action="includes/login.inc.php" class="login-form", method="post">
            <h1>Logowanie</h1>
            <div class="input-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" placeholder="Twój e-mail" required>
            </div>
            <div class="input-group">
                <label for="password">Hasło</label>
                <input type="password" id="password" name="pwd" placeholder="Twoje hasło" required>
            </div>
            <?php 
                //check_login_errors();
            ?>
            <button type="submit">Zaloguj się</button>
            <a href="#" class="reset-password">Zapomniałeś hasła?</a>
            <a href="register.php" class="register-link">Zarejestruj się</a>
        </form>
    </div>
</body>
</html>
