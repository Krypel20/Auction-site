<?php
declare(strict_types=1);
require_once 'dbh.inc.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["get-auction-data"])) {
    $auctionId = $_POST["auction_id"];
    $query = "SELECT currentPrice FROM auctions WHERE auctionID = :auctionId";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':auctionId', $auctionId, PDO::PARAM_INT);

    try {
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            // Przygotuj dane w formacie JSON
            header('Content-Type: application/json');
            echo json_encode($result);
        } else {
            echo json_encode(['error' => 'Nie znaleziono aukcji o ID: ' . $auctionId]);
        }
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Błąd zapytania SQL: ' . $e->getMessage()]);
    }

    exit;
}
