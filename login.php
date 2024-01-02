<?php 
    require_once "includes/config_session.inc.php";
    require_once "includes/login_view.inc.php";
    is_user_logged_in()
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
                media_if_not_logged_in();
            ?>
    </div>
</body>
</html>
