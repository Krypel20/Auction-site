<?php
declare(strict_types=1);
require_once 'dbh.inc.php';
//funkcje odpowiedzialne za interakcje z baza danych

function search_user(string $email, string $pwd){
    $query = "SELECT email FROM users WHERE email = email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":dbemail", $email);
    if($pwd == $dbpwd){
        return true;
    }else{
        return false;
    }
}

function get_email(object $pdo, string $email)
{
    $query = "SELECT username FROM users WHERE email = :email;"; //SELECT email?
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function is_email_registered(object $pdo, string $email)
{
    if(get_email($pdo, $email)){
        return true;
    }else{
        return false; 
    }
}