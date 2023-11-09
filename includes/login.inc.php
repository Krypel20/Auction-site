<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $email = $_POST["email"];
    $confirm_pwd = $_POST["confirm_pwd"];

    try {
        require_once 'dbh.inc.php';
        require_once 'login_model.inc.php';
        require_once 'login_contr.inc.php';
    
        login_user($pwd, $email); //wysłanie prawidłowych danych do bazy danych
        header("Location: ../login.php?login=success");
    
        $pdo = null;
        $stmt = null;
        die();
    
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }    
    } else { 
    header("Location: ../login.php");
    exit();
}