<?php
$errors = [];

if (isset($_POST['submit'])){
    
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //upload danych aukcji
    $itemName = $_POST["itemName"];
    $description = $_POST["description"];
    $endDate = $_POST["end_date"];
    $category = $_POST["category"];
    $askingPrice = $_POST["asking_price"];

    //Upload zdjecia aukcji
    $image = $_FILES['file'];
    $imageName = $_FILES['file']['name'];
    $imageTmpName = $_FILES['file']['tmp_name'];
    $imageSize = $_FILES['file']['size'];
    $imageError = $_FILES['file']['error'];
    $imageType = $_FILES['file']['type'];

    $imageExt = explode('.', $imageName);
    $imageActualExt = strtolower(end($imageExt));

    $allowed = array('jpg', 'jpeg', 'png');

    if(in_array($imageActualExt, $allowed)){
        if($imageError === 0){
            if($imageSize < 2000000){
                $imageNameNew = $imageName.uniqid('', true).".". $imageActualExt;
                $imageDestination = "../uploads/".$imageNameNew; //lokalizacja folderu ze zdjęciami aukcji na serwerze
                echo "Poprawnie załadowano zdjęcie";    
            }
            else{
                echo "Za duży rozmiar zdjęcia";
                $errors['image_too_big'] = "Za duży rozmiar zdjęcia";
            }
        } else {
            echo "Bład podczas wczytywania zdjęcia";
            $errors['image_upload_error'] = "Błąd podczas wczytywania zdjęcia";
        }
    }else{
        echo "Zdjęcie powinno mieć rozszerzenie .png/.jpg/.jpeg";
        $errors['image_type_error'] = "Zdjęcie powinno mieć rozszerzenie .png/.jpg/.jpeg";
    }

    $picture = $imageNameNew;

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

    if($errors){
        $_SESSION["auction_create_errors"] = $errors; 
        header("Location: ../create_auction.php?create=error");
        exit();
    }

    try {
        require_once 'dbh.inc.php';
        require_once 'createAuction_model.inc.php';
        require_once "config_session.inc.php";

        create_auction($pdo, $itemName, $description, $endDate, $askingPrice, $picture, $category); 
        move_uploaded_file($imageTmpName, $imageDestination); //przeniesienie zdjęcia na serwer 
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
