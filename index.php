<?php 
    require_once "includes/config_session.inc.php";
    require_once "includes/login_view.inc.php";
    $_SESSION['url'] = $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html>
<html lang="pl">
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Aukcyjny</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<body>
    <header>
        <?php include 'nav.php' ?>
        <div class="title-header">
            <div class="logo"> <img src="img/AuctionHammer.png"/></div>
            <h1>Portal Aukcyjny</h1> 
            Strona poświęcona aukcjom i sprzedaży towarów wartościowych
        </div>
    </header>
<div class="container">
    <div class="content-box">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce euismod molestie nunc, ac viverra dui venenatis id. Nullam nec ligula vitae arcu mattis ultricies. Sed bibendum sapien at purus lobortis, vel interdum justo volutpat. Suspendisse nec justo ut arcu fermentum feugiat. Proin rhoncus semper mauris, vel efficitur ligula ultrices eu. Integer auctor sapien vel turpis vehicula, ut sollicitudin tortor fringilla. Vivamus gravida tortor eget ligula consequat, ut ullamcorper elit tincidunt. Sed quis eros nec ipsum tincidunt accumsan. In hac habitasse platea dictumst. Quisque quis elit non lectus dignissim euismod.
    </div>
    <div class="tiles">
        <div class="picture-box">
            <a href="present_auctions.php" class="custom-link" id="Aktualne_aukcje">
                <img src="img/Latest_auctions.jpg" alt="Latest Auctions">
                <span class="caption">Aktualne aukcje</span>
            </a>
        </div>
        <div class="picture-box">
            <a href="present_auctions.php" class="custom-link" id="stworz_aukcje">
                <img src="img/hammer.jpg" alt="Latest Auctions">
                <span class="caption">Dodaj aukcje</span>
            </a>
        </div>
    </div>
</div>
    <?php include 'includes/footer.php' ?>
</body>
</html>
