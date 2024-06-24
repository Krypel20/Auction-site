<?php 
    require_once "includes/config_session.inc.php";
    require_once "includes/presentAuctions.inc.php";
    require_once "includes/presentAuctions_model.inc.php";
    require_once "includes/login_view.inc.php";
    $_SESSION['url'] = $_SERVER['REQUEST_URI']; //zapisanie strony jako ostatniej odwiedzonej przez użytkownika
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
    <title>Portal Aukcyjny</title>
</head>
<body>
    <header>
        <?php include 'nav.php' ?>
        <div class="title-header">
            <h1>Aukcje bliskie zakończenia</h1> 
        </div>
    </header>
<div class="container">
<main>
    <div class="left">
        <div class="section-title">Kategorie aukcji</div><br>
        <?php 
            //wyswietlenie po prawej stronie strony dostępnych kategorii wyszukiwania aukcji
            $categories = getCategories($pdo);
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
        <?php
            //odpowiednie wyświetlenie danych ostatnich aukcji, wyciągnietych z bazy przy pomocy funkcji getLatestAuciotns
            //Informacjie każdej aukcji znajdują się w osobnym obiekcie .auction
            $auctions = getLatestAuctions($pdo);
            if ($auctions == null){?>
                <h1>Aktualnie nie prowadzone są żadne aukcje</h1>
        <?php } 
            else{?>
            <?php foreach ($auctions as $auction)
                {
                    $auctionId = $auction['auctionID'];
                    $auctionEndDateTimestamp = strtotime($auction['endDate']);
                    if ($auctionEndDateTimestamp && $auctionEndDateTimestamp < $currentTimestamp){
                        closeAuction($pdo, $auctionId);
                    }
                    ?>
                    <a href="auction.php?id=<?php echo urlencode($auction['auctionID'])?>">
                        <div class="auction">
                            <div class="auction-left">
                            <p style='font-size: 15px;'><p class="timer"></p>
                                <p class="picture"><img src="<?php echo "uploads/{$auction['picture']}"?>"></p>
                            </div>
                            <div class="auction-right">
                                <p class="auctionName"><?php echo $auction['itemName'] ?></p>
                                <p class="categoryName"><?php echo $auction['category'] ?></p>
                                <p class="description"><?php echo $auction['description'] ?></p>
                    </a>
                                <p class="askingPrice">Cena wywoławcza: <?php echo $auction['askingPrice'] ?> zł</p>
                                <p class="sellerName">Sprzedawany przez: <a id='seller_name'><?php get_user_name($pdo, $auction['userID']); ?> </a></p><br>
                                <p class="currentPrice" data-auction-id="<?php echo $auctionId; ?>">Aktualna cena: <?php echo $auction['currentPrice'] ?> zł</p>
                                <p class="auctioneerName">Licytowany przez: <a id='auctioneer_name' data-auction-id="<?php echo $auctionId; ?>"><?php get_user_name($pdo, $auction["auctioneerID"]);?> </a></p>
                                <?php
                                //wyswietlanie pola do licytacji tylko w przypadku gdy uzytkownik jest zalogowany
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
                                <div class="error-message-box" data-auction-id="<?php echo $auctionId; ?>" style="display: none;">
                                    <div class="error-box"></div>
                                    <button class="confirm-ok">OK</button>
                                </div>
                            </div>
                                <div class='fog' style="display: none;" data-auction-id="<?php echo $auctionId; ?>"></div>      
                        </div>
                <?php
                }
            ?>
        <?php } ?>
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
// Uruchom funkcję aktualizacji dla każdego identyfikatora co 1 sekunde
auctionIds.forEach(auctionId => {
    setInterval(() => updateData(auctionId), 1000);
});

// Pobierz daty zakończenia aukcji z PHP
const auctionEndDates = <?php echo json_encode(array_column($auctions, 'endDate')); ?>;

// Uruchom funkcję aktualizacji liczników na podstawie pobranych dat
updateCountdownTimers(auctionEndDates);

// Uruchom funkcję aktualizacji co 1 sekunde
// Uruchom funkcję aktualizacji co 1 sekunde
setInterval(() => updateCountdownTimers(auctionEndDates), 1000);
</script>
    <?php include 'includes/footer.php' ?>
</body>
</html>
