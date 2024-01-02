<?php
declare(strict_types=1);
require_once 'dbh.inc.php';
//Funkcje do interakcji z baza danych

//sprawdza czy podany username jest juz w bazie danych
function get_username(object $pdo, string $username)
{
    $query = "SELECT username FROM users WHERE username = :username;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

//sprawdza czy podany email jest juz w bazie danych
function get_email(object $pdo, string $email)
{
    $query = "SELECT username FROM users WHERE email = :email;"; //SELECT email?
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

//wprowadza dane nowego użytkownika do tabeli users
function set_user(object $pdo, string $username, string $pwd, string $email)
{
    $query = "INSERT INTO users (username, pwd, email) VALUES (:username, :pwd, :email);";
    $stmt = $pdo->prepare($query);

    //kryptowanie hasla przy uzyciu algorytmu PASSWORD_BCRYPT
    $options = [ 'cost' => 12 ];
    $hashedPwd= password_hash($pwd, PASSWORD_BCRYPT, $options); 

    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":pwd", $hashedPwd);; //kryptowane haslo trafia do tabeli
    $stmt->bindParam(":email", $email);
    $stmt->execute();
}