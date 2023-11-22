<?php
declare(strict_types=1);
require_once 'dbh.inc.php';
//funkcje odpowiedzialne za interakcje z baza danych

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

function getLatestAuctions($pdo, $limit){

    $query = "SELECT * FROM auctions ORDER BY endDate LIMIT $limit";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return $data;
}