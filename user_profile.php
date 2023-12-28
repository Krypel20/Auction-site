<?php 
    require_once "includes/config_session.inc.php";
    require_once "includes/userPage_model.inc.php";
    require_once "includes/presentAuctions_model.inc.php";
    // require_once "includes/userPage_model.inc.php";
    is_user_logged_in();
    $_SESSION['url'] = $_SERVER['REQUEST_URI']; //zapisanie strony jako ostatniej odwiedzonej przez użytkownika
    $userID = $_SESSION['user_id'];
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
        <?php include 'nav.php' ?>
        <div class="profile-header">
            <div class="profile-picture"><img src="img/avatar.png"></div>
            <p id="username"><?php echo $_SESSION ["user_username"] ?></p>
            <button type="button" class="edit-profile-button">Edytuj profil</button>
        </div>
    </header>
<main>
    <div class="profile-info">
        <p class="title">Aukcje utworzone przez ciebie</p>
        <div class="created-auctions">
            <?php
                $CreatedAuctions = getAucitonsCreatedByUser($pdo, $userID);
                foreach ($CreatedAuctions as $CreatedAuction) {
                    ?>
                    <a href="auction.php?id=<?php echo urlencode($CreatedAuction['auctionID'])?>">
                        <div class="auction">
                            <div class="element"><p class="auction-title"> <?php echo $CreatedAuction['itemName']?></p></div>
                            <div class="element tab">
                                <p class="asking-price">Wywoławcza: <?php echo $CreatedAuction['askingPrice']?> zł</p><br>
                                <p class="current-price">Aktualnie: <?php echo $CreatedAuction['currentPrice']?> zł</p>
                            </div>
                            <div class="element" style="border: none;"><p class="timer"><?php echo $CreatedAuction['endDate'] ?></p></div>
                        </div>
                    </a>
                    <?php
                }
            ?>
        </div>
        <p class="title">Aukcje licytowane przez ciebie</p>
        <div class="created-auctions">
            <?php
                $LicitAuctions = getAucitonsLicitByUser($pdo, $userID);
                foreach ($LicitAuctions as $LicitAuction) {
                    ?>
                    <a href="auction.php?id=<?php echo urlencode($LicitAuction['auctionID'])?>">
                        <div class="auction">
                            <div class="element"><p class="auction-title"> <?php echo $LicitAuction['itemName']?></p></div>
                            <div class="element tab">
                                <p class="asking-price">Wywoławcza: <?php echo $LicitAuction['askingPrice']?> zł</p><br>
                                <p class="current-price">Aktualnie: <?php echo $LicitAuction['currentPrice']?> zł</p>
                            </div>
                            <div class="element" style="border: none;"><p class="timer"><?php echo $LicitAuction['endDate'] ?></p></div>
                        </div>
                    </a>
                    <?php
                }
            ?>
        </div>
    </div>
</main>
<script src="js/timers.script.js"> </script>
<script src="js/update_data.script.js"></script>
<script>
    <?php $allAuctions = array_merge($CreatedAuctions, $LicitAuctions); ?>
    const auctionIds = <?php echo json_encode(array_column($allAuctions, 'auctionID')); ?>;

    // Uruchom funkcję aktualizacji dla każdej aukcji na stronie co 1 sekunde
    auctionIds.forEach(auctionId => {
        setInterval(() => updateData(auctionId), 1000);
    });
    // Pobierz daty zakończenia aukcji z PHP
    const auctionEndDates = <?php echo json_encode(array_column($allAuctions, 'endDate')); ?>;

    // Uruchom funkcję aktualizacji liczników na podstawie pobranych dat    
    updateCountdownTimers(auctionEndDates);

    // Uruchom funkcję aktualizacji co 5 sekund
    setInterval(() => updateCountdownTimers(auctionEndDates), 1000);
</script>
<footer>
    <?php include 'includes/footer.php' ?>
</footer>
</body>
</html>

