<?php
declare(strict_types=1);
require_once 'dbh.inc.php';
require_once "config_session.inc.php";
//funkcje odpowiedzialne za interakcje z baza danych

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["confirm-licit"])) {
    if(!isset($_SESSION["user_id"]))
    {
        echo 'Zaloguj się by licytować';
        die();
    }else $newAuctioneerID = $_SESSION["user_id"];

    $auctionId = $_POST["auction_id"]; 
    $newPrice = floatval($_POST["new_price"]);

    try {
        require_once "presentAuctions_model.inc.php";

        $result = getAuctionData($pdo, $auctionId);

        if ($result) {
            // Pobierz dane do nowych zmiennych
            $currentAuctioneerID = $result['auctioneerID'];
            $sellerID = $result['userID'];
            $currentPrice = $result['currentPrice'];

            // Sprawdzenie błędów
            $errors = [];
            if($sellerID==$newAuctioneerID){
                $errors['invalid_auciton'] = 'Nie możesz zalicytować na własny przedmiot';
            }
            elseif($currentAuctioneerID==$newAuctioneerID){
                $errors['already_bid'] = 'Już licytujesz ten przedmiot'; 
            }
            elseif ($newPrice <= $currentPrice || !is_numeric($newPrice)){
                echo "Nowa cena musi być większa od aktualnej ($newPrice jest mniejsze od $currentPrice) ";
                $errors['invalid_price'] = 'Nowa cena musi być większa od aktualnej '; 
            } 
            else {
                saveLicitData($pdo, $auctionId, $newAuctioneerID, $newPrice);
                echo "Licytacja udana!";
            }

            if($errors){
                $_SESSION["errors_bid"] = $errors; //wyświetlanie informacji o błędach
                foreach ($errors as $error) echo $error;
                die();
            }
        }else{
                echo "Nie znaleziono aukcji o ID: $auctionId";
            }
    } catch (PDOException $e) {
        echo "Błąd zapytania SQL: " . $e->getMessage();
    }
    exit;
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

function getLatestAuctions(object $pdo){

    $query = "SELECT * FROM auctions WHERE endDate >= CURDATE() ORDER BY endDate LIMIT 20";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return $data;
}

function get_seller_name(object $pdo, $userID)
{
    $query = "SELECT username FROM users WHERE id = :userID";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
    $stmt->execute();
    $seller_name = $stmt->fetch(PDO::FETCH_ASSOC);
    echo $seller_name['username'];
}

function get_auctioneer_name(object $pdo, $auctioneerID)
{
    $query = "SELECT username FROM users WHERE id = :auctioneerID";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':auctioneerID', $auctioneerID, PDO::PARAM_INT);
    $stmt->execute();
    $seller_name = $stmt->fetch(PDO::FETCH_ASSOC);
    echo $seller_name['username'];
}