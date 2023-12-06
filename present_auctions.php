<?php 
    require_once "includes/config_session.inc.php";
    require_once "includes/presentAuctions.inc.php";
    require_once "includes/login_view.inc.php";
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Strona aukcyjna, sprzedawaj kupuj i licytuj">
    <link rel="stylesheet" type="text/css" href="css/presentAuctions.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Nazwa Strony</title>
    <meta http-equiv="refresh" content="100">
</head>
<body>
    <header>
        <?php include 'includes/nav.php' ?>
        <div class="title-header">
            <h1>Aukcje bliskie zakończenia</h1> 
        </div>
    </header>
<div class="container">
<main>
    <div class="left">
        <div class="section-title">Kategorie aukcji</div><br>
        <?php $categories = getCategories($pdo)?>
        <?php 
            foreach ($categories as $category)
            {
                ?>
                    <a href="category.php?category=<?php echo urlencode($category['category'])?>">
                        <?php echo ucfirst($category['category']) ?></a>
                <?php
            }
        ?>
    </div> 
    <div class="right">         
        <!-- <div class="section-title"></div> -->
        <?php $auctions = getLatestAuctions($pdo);

                foreach ($auctions as $auction)
                {
                    $auctionId = $auction['auctionID'];
                    ?>
                    <div class="auction">
                        <div class="auction-left">
                            <p class="categoryName"><?php echo $auction['category'] ?></p>
                            <p class="picture"><img src="<?php echo "img/{$auction['picture']}"?>"></p>
                        </div>
                        <div class="auction-right">
                            <p class="auctionName"><?php echo $auction['itemName'] ?></p>
                            <p class="endDate">Trwa do: <?php echo $auction['endDate'] ?></p>
                            <p class="status"><?php echo $auction['status'] ?></p>
                            <p class="description"><?php echo $auction['description'] ?></p>
                            <p class="askingPrice">Cena wywoławcza: <?php echo $auction['askingPrice'] ?>zł</p>
                            <p class="currentPrice">Aktualna cena: <?php if($auction['currentPrice'] == NULL) { echo $auction['askingPrice']; } else { echo $auction['currentPrice']; } ?>zł</p>
                            <button type="button" class="bid-button" data-auction-id="<?php echo $auctionId; ?>">Licytuj</button>
                            <input type="number" name="new_price" id="new_price" step="1" required></input>
                            <p id='timer'></p>
                            <div class="message-box" data-auction-id="<?php echo $auctionId; ?>">
                                <p>Czy na pewno chcesz zalicytować?</p>
                                <button class="confirm-yes">Tak</button>
                                <button class="confirm-no">Nie</button>
                            </div>
                            <p class='auction_id' style='position: absolute; right: 20px; bottom: 10px;'>id: <?php echo $auctionId; ?></p>
                        </div>
                    </div>
                <?php
                }
            ?>
        </div>
    </div>
</main>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
    var bidButtons = document.querySelectorAll(".bid-button");
    var messageBoxes = document.querySelectorAll(".message-box");

    bidButtons.forEach(function (button, index) {
        button.addEventListener("click", function () {
            var auctionId = button.getAttribute("data-auction-id");
            var currentMessageBox = document.querySelector(".message-box[data-auction-id='" + auctionId + "']");

            if (currentMessageBox) {
                currentMessageBox.style.display = "block";

                var confirmYesButton = currentMessageBox.querySelector(".confirm-yes");
                var confirmNoButton = currentMessageBox.querySelector(".confirm-no");

                // Utwórz domknięcie, aby zachować wartość auctionId
                confirmYesButton.addEventListener("click", function () {
                    // Zapisanie wartości auctionId przed użyciem w funkcji fetch
                    var auctionIdToSend = auctionId;
                    var newPriceToSend = document.getElementById("new_price").value;

                    // Po potwierdzeniu wywołaj zapytanie Ajax
                    fetch('includes/presentAuctions.inc.php', {
                        method: 'POST',
                        body: new URLSearchParams({
                            'confirm-licit': '1',
                            'auction_id': auctionIdToSend,
                            'new_price': newPriceToSend,
                        }),
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        credentials: 'include', // Dodane credentials dla przesyłania danych sesji
                    })
                    .then(response => response.text())
                    .then(data => {
                        console.log(data);
                    })
                    .catch(error => {
                        console.error('Błąd zapytania Ajax:', error);
                    });

                    currentMessageBox.style.display = "none";
                });

                confirmNoButton.addEventListener("click", function () {
                    currentMessageBox.style.display = "none";
                });
            }
        });
    });
});
</script>
    <?php include 'includes/footer.php' ?>
</body>
</html>
