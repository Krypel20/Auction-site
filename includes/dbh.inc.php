<?php 
// $dsn = "mysql:host=localhost;dbname=serwissprzedazowy";
// $dbusername = "root";
// $dbpassword = "";

// Dane do połączenia z bazą
$host = "localhost"; 
$dbName = "serwissprzedazowy";
$dbusername = "root";
$dbpassword = "";
try {
    // $pdo = new PDO($dsn, $dbusername, $dbpassword);
    // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

     // Połączenie z bazą danych
  $conn = new PDO("mysql:host=$host;dbname=$dbName", $dbusername, $dbpassword);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Błąd połączenia: ". $e->getMessage();
}