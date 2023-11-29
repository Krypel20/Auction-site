<?php 
    require_once "includes/config_session.inc.php";
    require_once "includes/createAuction_view.inc.php";
    //$categories = get_categories_from_db($pdo);
    is_user_logged_in();
?>
<!DOCTYPE html>
<html lang="pl">
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auction House</title>
    <link rel="stylesheet" type="text/css" href="css/createAuction.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<header>
        <?php include 'includes/nav.php' ?>
</header>
    <div class="create-auction-container">
        <form action="includes/createAuction.inc.php" class="create-auction-form" method="post">
            <h1>Tworzenie aukcji</h1>
            <div class="first-sector">
                <div class="column">
                    <label for="itemName">Nazwa Przedmiotu:</label>
                    <input type="text" name="itemName" id="itemName" required>

                    <label for="category">Kategoria:</label>
                    <select name="category" id="category" required>
                        <?php
                            foreach ($categories as $category) {
                                echo "<option value=\"$category\">$category</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="column">
                    <label for="endDate">Planowana Data Zakończenia:</label>
                    <input type="datetime-local" name="end_date" id="end_date" required>

                    <label for="askingPrice">Cena Wywoławcza:</label>
                    <input type="number" name="asking_price" id="asking_price" step="0.01" required>
                </div>
            </div>
            <div class="second-sector">
                <label for="description">Opis:</label>
                <textarea name="description" id="description" rows="4" required></textarea>

                <label for="picture">Dodaj Zdjęcie:</label>
                <input type="file" name="picture" id="picture" accept="image/*">
            </div>
            <button type="submit">Dodaj aukcje</button>
        </form>
    </div>
    <!-- <?php include 'includes/footer.php' ?> -->
</body>
</html>

