<?php

// Inicjalizacja tablicy na ewentualne błędy walidacji
$errors = [];

// Sprawdzenie, czy dane zostały przesłane za pomocą metody POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Pobranie danych aukcji
    $itemName = $_POST["itemName"];
    $description = $_POST["description"];
    $endDate = $_POST["end_date"];
    $category = $_POST["category"];
    $askingPrice = $_POST["asking_price"];

    // Pobranie danych o przesłanym zdjęciu aukcji
    $image = $_FILES['file'];
    $imageName = $_FILES['file']['name'];
    $imageTmpName = $_FILES['file']['tmp_name'];
    $imageSize = $_FILES['file']['size']; // Rozmiar zdjęcia
    $imageError = $_FILES['file']['error'];
    $imageType = $_FILES['file']['type'];

    // Podział nazwy pliku na rozszerzenie
    $imageExt = explode('.', $imageName);
    $imageActualExt = strtolower(end($imageExt));

    // Dozwolone rozszerzenia plików
    $allowed = array('jpg', 'jpeg', 'png');

    // Sprawdzenie, czy przesłane zdjęcie ma dozwolone rozszerzenie
    if (in_array($imageActualExt, $allowed)) {
        // Sprawdzenie, czy podczas przesyłania nie wystąpiły błędy
        if ($imageError === 0) {
            // Sprawdzenie, czy rozmiar przesłanego zdjęcia nie przekracza 2 MB
            if ($imageSize <= 2000000) {
                // Przygotowanie unikalnej nazwy pliku
                $imageNewName = $imageName . uniqid('', true) . "." . $imageActualExt;
                // Lokalizacja docelowa na serwerze dla zapisanego zdjęcia
                $imageDestination = "../uploads/" . $imageNewName;
                echo "Poprawnie załadowano zdjęcie";
            } else {
                echo "Za duży rozmiar zdjęcia";
                $errors['image_too_big'] = "Za duży rozmiar zdjęcia";
            }
        } else {
            echo "Błąd podczas wczytywania zdjęcia";
            $errors['image_upload_error'] = "Błąd podczas wczytywania zdjęcia";
        }
    } else {
        echo "Zdjęcie powinno mieć rozszerzenie .png/.jpg/.jpeg";
        $errors['image_type_error'] = "Zdjęcie powinno mieć rozszerzenie .png/.jpg/.jpeg";
    }

    // Przypisanie nazwy zapisanego zdjęcia do zmiennej
    $picture = $imageNewName;

    // Walidacja pól formularza aukcji
    if (empty($itemName)) {
        $errors['missing_item_name'] = "Pole Nazwa przedmiotu jest wymagane.";
    }

    if (empty($description)) {
        $errors['missing_description'] = "Pole Opis jest wymagane.";
    }

    if (empty($endDate)) {
        $errors['missing_end_date'] = "Pole Data zakończenia jest wymagane.";
    }

    if (empty($category)) {
        $errors['missing_category'] = "Pole Kategoria jest wymagane.";
    }

    if (empty($askingPrice)) {
        $errors['missing_asking_price'] = "Pole Cena wywoławcza jest wymagane.";
    }

    // Jeśli wystąpiły błędy walidacji, przekieruj na stronę z informacją o błędzie
    if ($errors) {
        $_SESSION["auction_create_errors"] = $errors;
        header("Location: ../create_auction.php?create=error");
        exit();
    }

    try {
        require_once 'dbh.inc.php';
        require_once 'createAuction_model.inc.php';
        require_once "config_session.inc.php";

        // Utworzenie aukcji w bazie danych
        set_auction($pdo, $itemName, $description, $endDate, $askingPrice, $picture, $category);

        // Przeniesienie przesłanego zdjęcia na serwer
        move_uploaded_file($imageTmpName, $imageDestination);

        header("Location: ../create_auction.php?create=success");

        $pdo = null;
        $stmt = null;
        die();

    } catch (PDOException $e) {
        // Obsługa błędów związanych z bazą danych
        die("Query failed: " . $e->getMessage());
    }
} else {
    // Przekierowanie w przypadku braku danych POST
    header("Location: ../create_auction.php");
    exit();
}
