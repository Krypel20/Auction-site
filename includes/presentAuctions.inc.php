<?php
declare(strict_types=1);
require_once 'dbh.inc.php';
require_once "config_session.inc.php";
//funkcje odpowiedzialne za interakcje z baza danych

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["confirm-licit"])) {
    $auctioneerID = $_SESSION["user_id"]; 
    $auctionID = $_POST["auction_id"]; 
    $newPrice = floatval($_POST["new_price"]);
    $currentPrice = floatval($auction['currentPrice']); 

    // Sprawdzenie, czy nowa cena jest większa od aktualnej
    if ($newPrice > $currentPrice && $auctioneerID) {
        saveLicitData($pdo, $auctionID, $auctioneerID, $newPrice);
        echo "Licytacja udana!";
    } else {
        echo "Nowa cena musi być większa od aktualnej.";
    }
}

function confirmLicit() {
    // Tutaj można umieścić kod obsługujący potwierdzenie, na przykład wywołanie JavaScript, aby zapytać użytkownika o potwierdzenie
    // W tym przykładzie zakładamy, że użytkownik zawsze potwierdzi licytację
    return true;
}

function saveLicitData($pdo, $auctionID, $auctioneerID, $newPrice) {
    try {
        $stmt = $pdo->prepare("UPDATE auctions SET auctioneerID = :auctioneerID, currentPrice = :currentPrice WHERE auctionID = :auctionID");
        $stmt->bindParam(':auctionID', $auctionID);
        $stmt->bindParam(':auctioneerID', $auctioneerID);
        $stmt->bindParam(':currentPrice', $newPrice);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Błąd bazy danych: " . $e->getMessage();
    }
}



function getCategories(object $pdo)
{
    $query = "SELECT DISTINCT category FROM auctions";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $categories[] = $row;
    }
    return $categories;
}

function getLatestAuctions($pdo){

    $query = "SELECT * FROM auctions ORDER BY endDate LIMIT 20";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return $data;
}