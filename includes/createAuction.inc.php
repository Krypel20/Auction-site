<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $itemName = $_POST["itemName"];
    $description = $_POST["description"];
    $endDate = $_POST["end_date"];
    $askingPrice = $_POST["asking_price"];
    $picture = $_POST["picture"];


    try {
        require_once 'dbh.inc.php';
        require_once 'createAuction_model.inc.php';
        require_once 'createAuction_contr.inc.php';

        $errors = [];
        //Obsluga bledow przy dodawaniu aukcji

        require_once "config_session.inc.php";

        if($errors){
            $_SESSION["errors_auction_create"] = $errors; //wyświetlanie informacji o błędach
            header("Location: ../create_auction.php");
            die();
        }

        create_auction($pdo, $itemName, $description, $endDate, $askingPrice, $picture); //wysłanie danych aukcji do bazy danych
        header("Location: ../create_auction.php?create=success");

        $pdo = null;
        $stmt = null;
        die();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }    
} else { 
    header("Location: ../create_auction.php");
    exit();
}
