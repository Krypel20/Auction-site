<?php
declare(strict_types=1);
require_once 'dbh.inc.php';

//wprowadzenie danych aukcji do bazy danych
function set_auction(object $pdo, string $itemName, string $descr, string $endDate, string $askingPrice, string $picture, string $category)
{
    $userID = isset($_SESSION['user_id']) ? (int)$_SESSION['user_id'] : null;
    $currentPrice = $askingPrice;
    $query = "INSERT INTO auctions (userID, itemName, description, endDate, askingPrice, currentPrice, picture, category) VALUES (:userID, :itemName, :descr, :endDate, :askingPrice, :currentPrice, :picture, :category);";
    $stmt = $pdo->prepare($query);
    
    $stmt->bindParam(":userID", $userID, PDO::PARAM_INT);
    $stmt->bindParam(":itemName", $itemName, PDO::PARAM_STR);
    $stmt->bindParam(":descr", $descr, PDO::PARAM_STR);
    $stmt->bindParam(":endDate", $endDate, PDO::PARAM_STR);
    $stmt->bindParam(":askingPrice", $askingPrice, PDO::PARAM_STR);
    $stmt->bindParam(":currentPrice", $currentPrice, PDO::PARAM_STR);
    $stmt->bindParam(":picture", $picture, PDO::PARAM_STR);
    $stmt->bindParam(":category", $category, PDO::PARAM_STR);

    $stmt->execute();
}

