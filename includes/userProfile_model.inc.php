<?php
require_once 'dbh.inc.php';

function is_user_logged_in() 
{
    if(!isset($_SESSION['user_id'])){
        $time = new DateTime();
        $newtime = $time->Modify("+2 seconds");

        if(isset($_SESSION['url'])){
            $url = $_SESSION['url']; // adres ostatnio odwiedzonej strony
        }else{
            $url = "index.php"; // domyślna strona główna
        }
        header("Location: $url"); // przeniesienie na odpowiednią strone
    }
}

function getAucitonsCreatedByUser(object $pdo, $userId){
    $query = "SELECT * FROM auctions WHERE userID = ? ORDER BY (endDate >= CURRENT_TIMESTAMP) DESC, endDate >= CURRENT_TIMESTAMP, endDate";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(1, $userId, PDO::PARAM_INT);
    $stmt->execute();

    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return $data;
}

function getAucitonsLicitByUser(object $pdo, $userId){
    $query = "SELECT * FROM auctions WHERE auctioneerID = ? ORDER BY endDate";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(1, $userId, PDO::PARAM_INT);
    $stmt->execute();

    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return $data;
}