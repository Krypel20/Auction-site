<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja</title>
    <link rel="stylesheet" href="css/loginRegisterForm.css">
</head>
<body>
    <div class="login-container">
        <form action="includes/formhandler.inc.php" class="login-form" method="post">
            <h1>Rejestracja</h1>
            <div class="input-group">
                <label for="username">Nazwa użytkownika</label>
                <input type="text" id="username" name="username" placeholder="Nazwa użytkownika" required>
            </div>
            <div class="input-group">
                <label for="email">E-mail</label>
                <input type="text" id="email" name="email" placeholder="E-mail" required>
            </div>
            <div class="input-group">
                <label for="password">Hasło</label>
                <input type="password" id="password" name="pwd" placeholder="Hasło" required>
            </div>
            <div class="input-group">
                <label for="confirm-password">Potwierdź hasło</label>
                <input type="password" id="confirm-password" name="confirm_pwd" placeholder="Potwierdź hasło" required>
            </div>
            <?php
            if (isset($_GET['error'])) {
                echo "<p style='color: red; font-weight:bold;'>Wpisane hasła nie są zgodne</p>";
            }
            ?>
            <button type="submit">Zarejestruj się</button>
            <a href="login.php" class="login-link">Masz już konto? Zaloguj się</a>
        </form>
    </div>
</body>
</html>
