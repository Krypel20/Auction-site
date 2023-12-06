<?php
declare(strict_types=1);
require_once 'dbh.inc.php';
require_once "config_session.inc.php";
//funkcje odpowiedzialne za interakcje z baza danych

//zamien kod tak aby js na stronie dostarczał jedynie id aukcji, 
//a ponizszy kod pobierał dane z tabeli dla danej aukcji zamiast wysyłać wszystkie dane przez js

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["confirm-licit"])) {
    $newAuctioneerID = $_SESSION["user_id"];
    $currentAuctioneerID = $_POST['auctioneer_id'];
    $sellerID = $_POST['seller_id']; 
    $auctionID = $_POST["auction_id"]; 
    $newPrice = floatval($_POST["new_price"]);
    $currentPrice = floatval($_POST['current_price']); 
    // Sprawdzenie błędów
    $errors = [];

    if($sellerID==$newAuctioneerID){
        echo 'Nie możesz zalicytować na własny przedmiot';
        $errors['invalid_auciton'] = 'Nie możesz zalicytować na własny przedmiot';
    }
    elseif($currentAuctioneerID==$newAuctioneerID){
        echo 'Już licytujesz ten przedmiot';
        $errors['already_bid'] = 'Już licytujesz ten przedmiot'; 
    }
    elseif ($newPrice <= $currentPrice || !is_numeric($newPrice)){
        echo "Nowa cena musi być większa od aktualnej ($newPrice jest mniejsze od $currentPrice)";
        $errors['invalid_price'] = 'Za niska wartość licytacji'; 
    } 
    else {
        saveLicitData($pdo, $auctionID, $newAuctioneerID, $newPrice);
        echo "Licytacja udana!";
    }
}

function bid_errors(){
    if(isset($_SESSION['errors_bid'])){
        $errors = $_SESSION['errors_bid'];
        echo '<p class="form-error">'. $errors[0] .'</p>';
        unset($_SESSION['errors_bid']);
    }
}

function saveLicitData($pdo, $auctionID, $auctioneerID, $newPrice) {
    try {
        $stmt = $pdo->prepare("UPDATE auctions SET auctioneerID = :auctioneerID, currentPrice = :currentPrice WHERE auctionID = :auctionID");
        $stmt->bindParam(':auctionID', $auctionID);
        $stmt->bindParam(':auctioneerID', $auctioneerID);
        $stmt->bindParam(':currentPrice', $newPrice);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Błąd bazy danych: " . $e->getMessage();
    }
}


function getCategories(object $pdo)
{
    $query = "SELECT DISTINCT category FROM auctions";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $categories[] = $row;
    }
    return $categories;
}

function getLatestAuctions($pdo){

    $query = "SELECT * FROM auctions ORDER BY endDate LIMIT 20";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return $data;
}