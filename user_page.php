<?php 
    require_once "includes/config_session.inc.php";
    require_once "includes/userPage_view.inc.php";

    is_user_logged_in();
?>
<!DOCTYPE html>
<html lang="pl">
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auction House</title>
    <link rel="stylesheet" type="text/css" href="css/user_page.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <header>
        <nav class="navbar">
            <nav class="loggedout">
                <a href="index.php">Strona główna</a>
                <a href="#">Ostatnie Aukcje</a>
                <a href="#">Polityka prywatności</a>
            </nav>
        </nav>
        <div class="profile-header">
            <div class="profile-picture"><?php //get profile picture from db?></div>
            <p id="user-name"> </p>
        </div>
    </header>
<div class="profile-info">
    <p class="current-auctions"> Udział w aktualnych aukcjach licytowane/sprzedawane</p>
    <p class="auctions-history"> Historia sprzedanych/kupionych przedmiotów</p>
</div>
    <footer class="footer">
        Piotr Krypel <br>
        <p>&copy; 2023. Wszelkie prawa zastrzeżone</p>
    </footer>
</body>
</html>

