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
        <nav class="navbar">
            <nav class="loggedout">
                <a href="index.php">Strona główna</a>
                <a href="#">Ostatnie Aukcje</a>
                <a href="#">Polityka prywatności</a>
            </nav>
            <nav class="loggedin">
                <?php
                    if(isset($_SESSION["user_id"])){
                        //echo '<a class="hello-text">Witaj ' . $_SESSION ["user_username"] .'!</a>';
                        echo "<a href='user_page.php'>Profil</a>";
                        echo "<a href='create_auction.php'>Stwórz aukcje</a>";
                        echo "<a href='includes/logout.inc.php'>Wyloguj</a>";
                    }else{
                        echo "<a href='login.php'>Logowanie</a>";
                    }
                ?>
            </nav>
        </nav>
    </header>
<div class="create-auction-form">
    <form action="includes/createAuction.inc.php" class="create-auction" method="post">
        <h1>Tworzenie aukcji</h1>
        <label for="itemName">Nazwa Przedmiotu:</label>
        <input type="text" name="itemName" id="itemName" required>
        <br>

        <label for="category">Kategoria:</label>
        <select name="category" id="category">
            <?php
                foreach ($categories as $category) {
                    echo "<option value=\"{$category['categoryId']}\">{$category['categoryName']}</option>";
                }
            ?>
        </select>
        <br>
        <label for="description">Opis:</label>
        <textarea name="description" id="description" rows="4" required></textarea>

        <label for="endDate">Planowana Data Zakończenia:</label>
        <input type="datetime-local" name="end_date" id="end_date" required>

        <label for="askingPrice">Cena Wywoławcza:</label>
        <input type="number" name="asking_price" id="asking_price" step="0.01" required>
        <br>

        <label for="picture">Dodaj Zdjęcie:</label>
        <input type="file" name="picture" id="picture" accept="image/*">
        <br>
        <button type="submit">Dodaj aukcje</button>
    </form>
</div>
    <footer class="footer">
        Piotr Krypel <br>
        <p>&copy; 2023. Wszelkie prawa zastrzeżone</p>
    </footer>
</body>
</html>

