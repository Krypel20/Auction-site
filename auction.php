<?php 
    require_once "includes/config_session.inc.php";
    require_once "includes/presentAuctions.inc.php";
    require_once "includes/presentAuctions_model.inc.php";
    require_once "includes/auction.view.inc.php";
    require_once "includes/login_view.inc.php";
    $_SESSION['url'] = $_SERVER['REQUEST_URI']; //zapisanie strony jako ostatniej odwiedzonej przez użytkownika

    if(isset($_GET['id'])){
        $id = urldecode($_GET['id']);
        $auction = getAuctionById($pdo, $id);
    }
    
    $currentTimestamp = time();
    $auctionEndDateTimestamp = strtotime($auction['endDate']);

    if ($auctionEndDateTimestamp && $auctionEndDateTimestamp < $currentTimestamp){
        closeAuction($pdo, $id);
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Strona aukcyjna, sprzedawaj kupuj i licytuj">
    <link rel="stylesheet" type="text/css" href="css/auction.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Dom Aukcyjny</title>
</head>
<body>
    <header>
        <?php include 'nav.php' ?>
        <div class="title-header">
            <h1><?php echo 'Aukcja nr ' . $id; ?></h1> 
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
                <div class="auction">
                    <p class="auctionName"><?php echo $auction['itemName'] ?></p>
                    <p class="endDate timer"><?php echo $auction['endDate'] ?></p>
                    <div class="auction-bottom">
                        <div class="auction-left">
                                <p class="categoryName"><?php echo $auction['category'] ?></p>
                                <p class="picture"><img src="<?php echo "img/{$auction['picture']}"?>"></p>
                            <p class="sellerName">Sprzedający: <a id='seller_name' style="font-weight: bold;"><?php get_seller_name($pdo, $auction['userID']); ?> </a></p>
                        </div>
                        <div class="auction-right">
                            <p class="status"><?php echo $auction['status'] ?></p>
                            <p class="description"><?php echo $auction['description'] ?></p>
                            <p class="askingPrice">Cena wywoławcza: <?php echo $auction['askingPrice'] ?> zł</p><br>
                            <p class="currentPrice" data-auction-id="<?php echo $id; ?>">Aktualna cena: <?php echo $auction['currentPrice'] ?> zł</p>
                            <p class="auctioneerName">Licytowany przez: <a id='auctioneer_name' data-auction-id="<?php echo $id; ?>"><?php get_auctioneer_name($pdo, $auction["auctioneerID"]);?> </a></p>
                            <?php 
                                if (isset($_SESSION["user_id"]) && $auction['status']!='Closed'){ ?>
                                    <div class='bid-box'>
                                        <button type="button" class="bid-button" data-auction-id="<?php echo $id; ?>">Licytuj</button>
                                        <input type="number" class='new_price' name="new_price" id="new_price_<?php echo $id; ?>" step="1" value="<?php echo $auction['currentPrice'] + 10; ?>" required></input>
                                    </div>
                            <?php } ?>
                            <div class="message-box" data-auction-id="<?php echo $id; ?>">
                                <p>Czy na pewno chcesz zalicytować?</p>
                                <button class="confirm-yes">Tak</button>
                                <button class="confirm-no">Nie</button>
                            </div>
                            <div class="error-message-box" data-auction-id="<?php echo $id; ?>" style="display: none;">
                                <div class="error-box"></div>
                                <button class="confirm-ok">OK</button>
                            </div>
                        </div>
                    </div>    
                    <?php 
                        if($auction['status']=='Closed') {?>
                        <div class='fog' style="display: flex;" data-auction-id="<?php echo $id; ?>"></div>
                            <p class="auction-ended">Aukcja zakończona</p>
                            <p class="sold">Sprzedano za <?php echo $auction['currentPrice']?> zł</p>
                    <?php }else {?>
                            <div class='fog' style="display: none;" data-auction-id="<?php echo $id; ?>"></div>
                    <?php }?> 
                </div>
        </div>
    </div>
</main>
</div>
<script src="js/biding.script.js"> </script>
<script src="js/auction_timer.script.js"> </script>
<script src="js/update_data.script.js"></script>
<script>
// Pobierz identyfikator aukcji ze strony
const auctionId = <?php echo json_encode($auction['auctionID']); ?>;

// Uruchom funkcję aktualizacji dla każdej aukcji na stronie co 1 sekunde
setInterval(() => updateData(auctionId), 1000);

// Pobierz daty zakończenia aukcji z PHP
const auctionEndDate = <?php echo json_encode($auction['endDate']); ?>;

// Uruchom funkcję aktualizacji liczników na podstawie pobranych dat
updateCountdownTimers(auctionEndDate);

// Uruchom funkcję aktualizacji co 5 sekund
setInterval(() => updateCountdownTimers(auctionEndDate), 1000);
</script>
    <?php include 'includes/footer.php' ?>
</body>
</html>
