<?php
declare(strict_types=1);
require_once 'dbh.inc.php';
require_once "config_session.inc.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["confirm-licit"])) {
    if (!isset($_SESSION["user_id"])) {
        http_response_code(400); // Nieprawidłowe żądanie
        echo json_encode(['error' => 'Zaloguj się by licytować']);
        die();
    } else {
        $newAuctioneerID = $_SESSION["user_id"];
    }

    $auctionId = $_POST["auction_id"];
    $newPrice = floatval($_POST["new_price"]);

    try {
        require_once "presentAuctions_model.inc.php";

        $result = getAuctionData($pdo, $auctionId);

        if ($result) {
            $currentAuctioneerID = $result['auctioneerID'];
            $sellerID = $result['userID'];
            $currentPrice = $result['currentPrice'];

            $errorMessage = '';
            if ($sellerID == $newAuctioneerID) {
                $errorMessage = 'Nie możesz zalicytować na własny przedmiot';
            } elseif ($currentAuctioneerID == $newAuctioneerID) {
                $errorMessage = 'Już licytujesz ten przedmiot';
            } elseif ($newPrice <= $currentPrice || !is_numeric($newPrice)) {
                $errorMessage = 'Nowa cena musi być większa od aktualnej';
            }

            if ($errorMessage !== '') {
                http_response_code(400); // Nieprawidłowe żądanie
                echo json_encode(['error' => $errorMessage]);
                exit();
            }

            // Jeśli nie było błędów, zapisz do bazy danych i zwróć sukces
            saveLicitData($pdo, $auctionId, $newAuctioneerID, $newPrice);
            echo json_encode(['success' => 'Licytacja udana']);
        } else {
            http_response_code(404); // Nie znaleziono
            echo "Nie znaleziono aukcji o ID: $auctionId";
        }
    } catch (PDOException $e) {
        http_response_code(500); // Błąd serwera
        echo json_encode(['error' => 'Błąd zapytania SQL: ' . $e->getMessage()]);
    }
    exit;
}
?>
