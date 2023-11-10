<?php 
    require_once "includes/config_session.inc.php";
    require_once "includes/login_view.inc.php";
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nazwa Strony</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <nav class="navbar">
            <a href="index.php">Strona główna</a>
            <a href="#">Ostatnie Aukcje</a>
            <a href="#">Polityka prywatności</a>
            <?php
                if(isset($_SESSION["user_id"])){
                    echo "<a href='user_profile.php'>Profil</a>";
                    echo "<a href='includes/logout.inc.php'>Wyloguj</a>";
                }else{
                    echo "<a href='login.php'>Logowanie</a>";
                }
            ?>

        </nav>
        <div class="title-header">
            <div class="logo"> <img src="img/AuctionHammer.png" /></div>
            <h1 style="font-weight: bold; font-size: 40px; margin-top:0px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">AuctionHousePL</h1> 
            Strona poświęcona aukcjom i sprzedaży wartościowych przedmiotów
        </div>
    </header>
<div class="container">
    <div class="box content-box"> jakaś zawartość</div>
    <div class="box picture-box"> jakaś zawartość</div>
</div>
    <footer class="footer">
        Piotr Krypel <br>
        <p>&copy; 2023. Wszelkie prawa zastrzeżone</p>
    </footer>
</body>
</html>
