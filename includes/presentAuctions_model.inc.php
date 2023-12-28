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

function getAuctionsByCategory(object $pdo, $category)
{
    $query = "SELECT * FROM auctions WHERE category = ? ORDER BY endDate LIMIT 20";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(1, $category, PDO::PARAM_STR);
    $stmt->execute();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return $data;
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

function getLatestAuctions(object $pdo){

    $query = "SELECT * FROM auctions WHERE endDate >= CURRENT_TIMESTAMP ORDER BY endDate LIMIT 20";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return $data;
}

function get_seller_name(object $pdo, $userID)
{
    $query = "SELECT username FROM users WHERE id = :userID";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
    $stmt->execute();
    $seller_name = $stmt->fetch(PDO::FETCH_ASSOC);
    echo $seller_name['username'];
}

function get_auctioneer_name(object $pdo, $auctioneerID)
{
    if($auctioneerID!=null)
    {
        $query = "SELECT username FROM users WHERE id = :auctioneerID";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':auctioneerID', $auctioneerID, PDO::PARAM_INT);
        $stmt->execute();
        $seller_name = $stmt->fetch(PDO::FETCH_ASSOC);
        echo $seller_name['username'];
    }
    else{
        echo '-';
    }
}

function closeAuction(object $pdo, $auctionID)
{
    $newStatus = 'Closed';
    try {
        $query = "UPDATE auctions SET status = :newStatus WHERE auctionID = :auctionID";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':auctionID', $auctionID);
        $stmt->bindParam(':newStatus', $newStatus);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Błąd bazy danych: " . $e->getMessage();
    }
}
