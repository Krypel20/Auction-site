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

//wyciąga dane aukcji z danej kategori
function getAuctionsByCategory(object $pdo, $category)
{
    $query = "SELECT * FROM auctions WHERE category = ? ORDER BY (endDate >= CURRENT_TIMESTAMP) DESC, endDate >= CURRENT_TIMESTAMP, endDate";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(1, $category, PDO::PARAM_STR);
    $stmt->execute();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return $data;
}

//wyciąga kategorie jakie posiadają wszystkie aukcje w bazie danych
function getCategories(object $pdo)
{
    $query = "SELECT DISTINCT category FROM auctions ORDER BY category";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $categories[] = $row;
    }
    return $categories;
}

//wyciąga dane aukcji z najbliższym czasem zakończenia
function getLatestAuctions(object $pdo){
    $query = "SELECT * FROM auctions WHERE endDate >= CURRENT_TIMESTAMP ORDER BY endDate";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $data = [];
    
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    if($data) return $data;
    else return;
}

//zwraca nazwę użytkownika na podstawie jego ID
function get_user_name(object $pdo, $userID)
{
    if($userID!=null)
    {
        $query = "SELECT username FROM users WHERE id = :userID";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
        $stmt->execute();
        $seller_name = $stmt->fetch(PDO::FETCH_ASSOC);
        echo $seller_name['username'];
    }
    else{
        echo '-';
    }
}

//ustawia status aukcji na 'zamknięta'
function closeAuction(object $pdo, $auctionID)
{
    $newStatus = 'Closed';
    try {
        $query = "UPDATE auctions SET status = :newStatus WHERE auctionID = :auctionID AND endDate <= CURRENT_TIMESTAMP ";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':auctionID', $auctionID);
        $stmt->bindParam(':newStatus', $newStatus);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Błąd bazy danych: " . $e->getMessage();
    }
}
