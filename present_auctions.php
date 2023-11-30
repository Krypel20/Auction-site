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
<script>
  const targetDate = new Date("2023-12-31T23:59:59");
  function updateTimer() {
    const currentDate = new Date();
    const timeDifference = targetDate - currentDate;

    const days = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
    const hours = Math.floor((timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);

    document.getElementById('timer').innerHTML = ${days}d ${hours}h ${minutes}m ${seconds}s;

    // Aktualizuj co sekundę
    setTimeout(updateTimer, 1000);
  }

  // Wywołaj funkcję po załadowaniu strony
  window.onload = function () {
    updateTimer();
  };
</script>
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
        <?php $auctions = getLatestAuctions($pdo,5)?>
            <?php 
                foreach ($auctions as $auction)
                {
                    ?>
                    <div class="auction">
                        <div class="auction-left">
                            <!-- <p class="categoryName"><?php echo $auction['category'] ?></p> -->
                            <p class="picture"><img src="<?php echo "img/{$auction['picture']}"?>"></p>
                        </div>
                        <div class="auction-right">
                            <p class="auctionName"><?php echo $auction['itemName'] ?></p>
                            <p class="endDate">Trwa do: <?php echo $auction['endDate'] ?></p>
                            <p class="status"><?php echo $auction['status'] ?></p>
                            <p class="description"><?php echo $auction['description'] ?></p>
                            <p class="askingPrice">Cena wywoławcza: <?php echo $auction['askingPrice'] ?>zł</p>
                            <p class="currentPrice">Aktualna cena: <?php if($auction['currentPrice'] == NULL) { echo $auction['askingPrice']; } else { echo $auction['currentPrice']; } ?>zł</p>
                            <button type="bid">Licytuj</button> <input type="number" id="new_price" step="1" required></input>
                            <p id='timer'></p>
                        </div>
                    </div>
                <?php
                }
            ?>
        </div>
    </div>
</main>
</div>
    <?php include 'includes/footer.php' ?>
</body>
</html>
