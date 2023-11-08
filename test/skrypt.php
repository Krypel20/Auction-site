<?php

// Dane do połączenia z bazą
$host = "localhost"; 
$dbName = "serwissprzedazowy";
$dbusername = "root";
$password = "";

try {

  // Połączenie z bazą danych
  $conn = new PDO("mysql:host=$host;dbname=$dbName", $dbusername, $password);

  // Odebranie danych z formularza
  $username = $_POST['username'];
  $password = $_POST['password'];
  $email = $_POST['email'];
  
  // Przygotowanie zapytania INSERT
  $sql = "INSERT INTO users (username, pwd, email) VALUES (:username, :password, :email)";

  $stmt = $conn->prepare($sql);

  // Podanie wartości parametrów  
  $stmt->bindParam(':username', $username);
  $stmt->bindParam(':password', $password);
  $stmt->bindParam(':email', $email);

  // Wykonanie zapytania
  $stmt->execute();

  echo "Dodano rekord do bazy!";

} catch(PDOException $e) {
    echo "Wystąpił błąd: " . $e->getMessage();
}

?>