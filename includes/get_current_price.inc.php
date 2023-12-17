<?php
require_once 'dbh.inc.php';
header('Content-Type: application/json');

if (isset($_GET['id'])) {
    $auctionId = $_GET['id'];

    // Zapytanie do bazy danych w celu pobrania aktualnej ceny
    $query = "SELECT currentPrice FROM auctions WHERE auctionID = :auctionId";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':auctionId', $auctionId, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($result);
} else {
    echo json_encode(['error' => 'Brak identyfikatora aukcji']);
}

