<?php 
    require_once "includes/config_session.inc.php";
    require_once "includes/presentAuctions.inc.php";
    require_once "includes/login_view.inc.php";

    if(isset($_GET['category']))
    {
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
    <title>Nazwa Strony</title>
    <meta http-equiv="refresh" content="10">
</head>
<body>
    <header>
    <?php include 'includes/nav.php' ?>
        <div class="title-header">
            <h1>Aktualne aukcje</h1> 
        </div>
    </header>
<div class="container">
    <div class="left">
        <div class="section-title">Kategorie aukcji</div>
        <?php $categories = getCategories($pdo)?>
        <?php 
            foreach ($categories as $category)
            {
                ?>
                    <a href="category.php?category=<?php echo urlencode($category['categoryName'])?>">
                        <?php echo ucfirst($category['categoryName']) ?>
                </a><br>
                <?php
            }
        ?>
    </div> 
    <div class="right">         
        <div class="section-title">Aukcje bliskie zakończenia</div>
        <?php $auctions = getLatestAuctions($pdo,1)?>
        <div class="product">
            <?php 
                foreach ($auctions as $auction)
                {
                    ?>
                    <div class="auction-left">
                        <p class="auctionName"><?php echo $auction['itemName'] ?></label>
                        <p class="description"><?php echo $auction['description'] ?></label>
                        <p class="endDate"><?php echo $auction['endDate'] ?></label>
                        <p class="askingPrice"><?php echo $auction['askingPrice'] ?></label>
                        <p class="currentPrice"><?php echo $auction['currentPrice'] ?></label>
                    </div>
                    <div class="auction-right">
                        <p class="categoryName"><?php echo $auction['categoryID'] ?></label>
                        <p class="picture"><?php echo $auction['picture'] ?></label>
                        <p class="status"><?php echo $auction['status'] ?></label>
                    </div>
                    <?php
                }
            ?>
        </div>
    </div>
</div>
    <?php include 'includes/footer.php' ?>
</body>
</html>
