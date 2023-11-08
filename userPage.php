<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nazwa Strony</title>
    <link rel="stylesheet" href="css/style.css"> <!-- Dodaj plik stylów CSS -->
</head>
<body>
    <header>
        <nav class="navbar">
            <a href="index.php">Strona główna</a>
            <a href="#">Blog</a>
            <a href="#">Kontakt</a>
            <a href="login.php" style="margin-right: 50px">Logowanie</a>
            <?php echo $_SESSION["username"]?>
        </nav>
        <div class="title-header"><h1 style="font-weight: bold; font-size: 40px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Profil użytkownika</div>
    </header>
<div class="container">
    
</div>
    <footer class="footer">
        Piotr Krypel <br>
        <p>&copy; 2023. Wszelkie prawa zastrzeżone</p>
    </footer>
</body>
</html>
