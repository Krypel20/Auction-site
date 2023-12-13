<?php 
    require_once "includes/config_session.inc.php";
    require_once "includes/presentAuctions.inc.php";
    require_once "includes/login_view.inc.php";
    $_SESSION['url'] = $_SERVER['REQUEST_URI']; //zapisanie strony jako ostatniej odwiedzonej przez użytkownika

    if(isset($_GET['category'])){
        $cat = urldecode($_GET['category']);
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Strona aukcyjna, sprzedawaj kupuj i licytuj">
    <link rel="stylesheet" type="text/css" href="css/presentAuctions.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Dom Aukcyjny</title>
</head>
<body>
    <header>
        <?php include 'nav.php' ?>
        <div class="title-header">
            <h1><?php echo $cat ?></h1> 
        </div>
    </header>
<div class="container">
<main>
    <div class="left">
    <a href="present_auctions.php" id="ostatnie_aukcje" >Bliskie zakończenia</a>
        <div class="section-title">Kategorie aukcji</div><br>
        <?php $categories = getCategories($pdo)?>
        <?php 
            foreach ($categories as $category)
            {
                ?>
                    <a href="auctions_category.php?category=<?php echo urlencode($category['category'])?>">
                        <?php echo ucfirst($category['category']) ?></a>
                <?php
            }
        ?>
    </div> 
    <div class="right">         
        <?php $auctions = getAuctionsByCategory($pdo, $cat); 
                foreach ($auctions as $auction)
                {
                    $auctionId = $auction['auctionID'];
                    ?>
                    <a href="auction.php?id=<?php echo urlencode($auctionId)?>">
                        <div class="auction">
                            <div class="auction-left">
                                <p class="endDate timer" auction-end="<?php echo $auction['endDate'] ?>">Do <?php echo $auction['endDate'] ?></p>
                                <p class="picture"><img src="<?php echo "img/{$auction['picture']}"?>"></p>
                            </div>
                            <div class="auction-right">
                                <p class="auctionName"><?php echo $auction['itemName'] ?></p>
                                <p class="categoryName"><?php echo $auction['category'] ?></p>
                                <p class="status"><?php echo $auction['status'] ?></p>
                                <p class="description"><?php echo $auction['description'] ?></p>
                    </a>
                                <p class="askingPrice">Cena wywoławcza: <?php echo $auction['askingPrice'] ?>zł</p>
                                <p class="sellerName">sprzedawany przez: <a id='seller_name' style="font-weight: bold;"><?php get_seller_name($pdo, $auction['userID']); ?> </a></p></br>
                                <p class="currentPrice">Aktualna cena: <?php echo $auction['currentPrice'] ?>zł</p>
                                <?php 
                                    if ($auction['currentPrice'] != $auction['askingPrice']){ ?>
                                        <p class="auctioneerName">licytowany przez: <a id='auctioneer_name' style="font-weight: bold; display: inline;"><?php get_auctioneer_name($pdo, $auction["auctioneerID"]);?> </a></p>
                                    <?php
                                    }?>
                                <?php 
                                    if (isset($_SESSION["user_id"])){ ?>
                                        <div class='bid-box'>
                                            <button type="button" class="bid-button" data-auction-id="<?php echo $auctionId; ?>">Licytuj</button>
                                            <input type="number" class='new_price' name="new_price" id="new_price_<?php echo $auctionId; ?>" step="1" value="<?php echo $auction['currentPrice'] + 10; ?>" required></input>
                                        </div>
                                <?php } ?>
                                <div class="message-box" data-auction-id="<?php echo $auctionId; ?>">
                                    <p>Czy na pewno chcesz zalicytować?</p>
                                    <button class="confirm-yes">Tak</button>
                                    <button class="confirm-no">Nie</button>
                                </div>
                            </div>
                            <div class='fog' data-auction-id="<?php echo $auctionId; ?>"></div>
                        </div>
                <?php
                }
            ?>
        </div>
    </div>
</main>
</div>
<script src="js/biding.script.js"> </script>
    <?php include 'includes/footer.php' ?>
</body>
</html>
