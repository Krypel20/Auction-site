<?php 
    require_once "includes/config_session.inc.php";
    require_once "includes/login_view.inc.php";
?>
<!DOCTYPE html>
<html lang="pl">
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nazwa Strony</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <?php include 'includes/nav.php' ?>
        <div class="title-header">
            <div class="logo"> <img src="img/AuctionHammer.png" /></div>
            <h1>Auction House PL</h1> 
            Strona poświęcona aukcjom i sprzedaży towarów wartościowych
        </div>
    </header>
<div class="container">
    <div class="box content-box"> <a href="present_auctions.php">Aktualne aukcje</a></div>
    <div class="box picture-box"> jakaś zawartość</div>
</div>
    <?php include 'includes/footer.php' ?>
</body>
</html>
