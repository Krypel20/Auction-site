<?php
declare(strict_types=1);
require_once 'dbh.inc.php';

//Funkcje do interakcji z baza danych
function set_auction(object $pdo, string $itemName, string $description, string $endDate, string $askingPrice, string $picture, string $category)
{
    $userID = isset($_SESSION['user_id']) ? (int)$_SESSION['user_id'] : null;
    $query = "INSERT INTO auctions (userID, itemName, description, endDate, askingPrice, picture, category) VALUES (:userID, :itemName, :description, :endDate, :askingPrice, :picture, :category);";
    $stmt = $pdo->prepare($query);
    
    $stmt->bindParam(":userID", $userID);
    $stmt->bindParam(":itemName", $itemName);
    $stmt->bindParam(":description", $description);
    $stmt->bindParam(":endDate", $endDate);
    $stmt->bindParam(":picture", $picture);
    $stmt->bindParam(":askingPrice", $askingPrice);
    $stmt->bindParam(":currentPrice", $askingPrice);
    $stmt->bindParam(":category", $category);
    $stmt->execute();
}

