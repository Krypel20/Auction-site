<?php 
    require_once "includes/config_session.inc.php";
    require_once "includes/presentAuctions.inc.php";
    require_once "includes/presentAuctions_model.inc.php";
    require_once "includes/login_view.inc.php";
    $_SESSION['url'] = $_SERVER['REQUEST_URI']; //zapisanie strony jako ostatniej odwiedzonej przez użytkownika

    if(isset($_GET['category'])){
        $cat = urldecode($_GET['category']);
    }
    $currentTimestamp = time();
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
                    $auctionEndDateTimestamp = strtotime($auction['endDate']);
                    if ($auctionEndDateTimestamp && $auctionEndDateTimestamp < $currentTimestamp){
                        closeAuction($pdo, $auctionId);
                    }
                    ?>
                    <a href="auction.php?id=<?php echo urlencode($auctionId)?>">
                        <div class="auction">
                            <div class="auction-left">
                                <p class="timer"></p>
                                <p class="picture"><img src="<?php echo "uploads/{$auction['picture']}"?>"></p>
                            </div>
                            <div class="auction-right">
                                <p class="auctionName"><?php echo $auction['itemName'] ?></p>
                                <p class="categoryName"><?php echo $auction['category'] ?></p>  
                                <p class="description"><?php echo $auction['description'] ?></p>
                    </a>
                                <p class="askingPrice">Cena wywoławcza: <?php echo $auction['askingPrice'] ?> zł</p>
                                <p class="sellerName">Sprzedawany przez: <a id='seller_name'><?php get_seller_name($pdo, $auction['userID']); ?> </a></p></br>
                                <p class="currentPrice" data-auction-id="<?php echo $auctionId; ?>">Aktualna cena: <?php echo $auction['currentPrice'] ?> zł</p>
                                <p class="auctioneerName">Licytowany przez: <a id='auctioneer_name' data-auction-id="<?php echo $auctionId; ?>"><?php get_auctioneer_name($pdo, $auction["auctioneerID"]);?> </a></p>
                                
                                <?php 
                                    if (isset($_SESSION["user_id"]) && $auction['status']!='Closed'){ ?>
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
                                <div class="error-message-box" data-auction-id="<?php echo $auctionId; ?>" style="display: none;">
                                    <div class="error-box"></div>
                                    <button class="confirm-ok">OK</button>
                                </div>
                            </div>

                            <?php 
                                if($auction['status']=='Closed') {?>
                                <div class='fog' style="display: flex;" data-auction-id="<?php echo $auctionId; ?>"></div>
                                    <div class="auction-closed">
                                        <p class="auction-ended">Aukcja zakończona <?php echo date('d.m.Y H:i', $auctionEndDateTimestamp); ?> </p>
                                        <p class="sold">Kupiono za <a style="color: red;"><?php echo $auction['currentPrice']?> zł</a><br>
                                        przez <a style="color: #00D100;"><?php get_auctioneer_name($pdo, $auction['auctioneerID'] )?></a></p>
                                    </div>
                            <?php }else {?>
                                <div class='fog' style="display: none;" data-auction-id="<?php echo $auctionId; ?>"></div>
                            <?php }?> 

                        </div>
                <?php
                }
            ?>
        </div>
    </div>
</main>
</div>
<script src="js/biding.script.js"> </script>
<script src="js/timers.script.js"> </script> 
<script src="js/update_data.script.js"></script>
<script>
// Pobierz identyfikatory aukcji z PHP
const auctionIds = <?php echo json_encode(array_column($auctions, 'auctionID')); ?>;

// Uruchom funkcję aktualizacji dla każdego identyfikatora co 1 sekunde
auctionIds.forEach(auctionId => {
    setInterval(() => updateData(auctionId), 1000);
});


// Pobierz daty zakończenia aukcji z PHP
const auctionEndDates = <?php echo json_encode(array_column($auctions, 'endDate')); ?>;

// Uruchom funkcję aktualizacji liczników na podstawie pobranych dat
updateCountdownTimers(auctionEndDates);

// Uruchom funkcję aktualizacji co 5 sekund
setInterval(() => updateCountdownTimers(auctionEndDates), 1000);
</script>
    <?php include 'includes/footer.php' ?>
</body>
</html>
