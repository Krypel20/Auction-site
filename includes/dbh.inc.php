<?php 
// Dane do połączenia z bazą
$host = "localhost"; 
$dbName = "serwissprzedazowy";
$dbusername = "root";
$dbpassword = "";

try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbName", $dbusername, $dbpassword);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Błąd połączenia: ". $e->getMessage();
}