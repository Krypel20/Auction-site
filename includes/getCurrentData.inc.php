<?php
require_once 'dbh.inc.php';
header('Content-Type: application/json');

if (isset($_GET['id'])) {
    $auctionId = $_GET['id'];

    // Zapytanie do bazy danych w celu pobrania aktualnej ceny i nazwy licytującego uzytkownika
    $query = "SELECT currentPrice, auctioneerID FROM auctions WHERE auctionID = :auctionId";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':auctionId', $auctionId, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $auctioneerID = $result['auctioneerID'];
    $auctioneerName = '';

    if ($auctioneerID !== null) {     // Pobranie nazwy licytującego uzytkownika
        $auctioneerQuery = "SELECT username FROM users WHERE id = :auctioneerID";
        $auctioneerStmt = $pdo->prepare($auctioneerQuery);
        $auctioneerStmt->bindParam(':auctioneerID', $auctioneerID, PDO::PARAM_INT);
        $auctioneerStmt->execute();
        $auctioneerResult = $auctioneerStmt->fetch(PDO::FETCH_ASSOC);
        $auctioneerName = $auctioneerResult ? $auctioneerResult['username'] : '';
    }

    echo json_encode(['result' => $result, 'auctioneerName' => $auctioneerName, 'query' => $query, 'auctionId' => $auctionId]);
} else {
    echo json_encode(['error' => 'Brak identyfikatora aukcji']);
}
