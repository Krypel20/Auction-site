<?php
declare(strict_types=1);
require_once 'dbh.inc.php';

//Funkcje do interakcji z baza danych
function set_auction(object $pdo, string $itemName, string $description, string $endDate, string $askingPrice, string $picture)
{
    $query = "INSERT INTO auctions (itemName, description, endDate, askingPrice ,picture) VALUES (:itemName, :description, :endDate, :askingPrice, :picture);";
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":itemName", $itemName);
    $stmt->bindParam(":description", $description);
    $stmt->bindParam(":endDate", $endDate);
    $stmt->bindParam(":picture", $picture);
    $stmt->bindParam(":askingPrice", $askingPrice);
    $stmt->execute();
}