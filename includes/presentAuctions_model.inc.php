<?php
declare(strict_types=1);
require_once 'dbh.inc.php';

//wyciąga dane aukcji z bazy danych
function getAuctionData(object $pdo, $auctionId){
    $query = "SELECT auctioneerID, userID, currentPrice FROM auctions WHERE auctionID = :auctionId";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':auctionId', $auctionId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

//zapisuje nowe dane licytowanej aukcji
function saveLicitData(object $pdo, $auctionID, $auctioneerID, $newPrice) {
    try {
        $query = "UPDATE auctions SET auctioneerID = :auctioneerID, currentPrice = :currentPrice WHERE auctionID = :auctionID";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':auctionID', $auctionID);
        $stmt->bindParam(':auctioneerID', $auctioneerID);
        $stmt->bindParam(':currentPrice', $newPrice);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Błąd bazy danych: " . $e->getMessage();
    }
}
