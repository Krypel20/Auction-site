<?php
declare(strict_types= 1);

function is_user_logged_in() 
{
    if(!isset($_SESSION['user_id'])){
        $time = new DateTime();
        $newtime = $time->Modify("+2 seconds");
        header("location:login.php");
    }
}

function get_categories_from_db(object $pdo) 
{
    // Pobieranie kategorii z bazy danych
    $query = "SELECT categoryId, categoryName FROM categories";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $categories;
}

function check_auction_creation_errors()
{
    if(isset($_SESSION['errors_signup'])){
        $errors = $_SESSION['errors_auction_create'];

        foreach($errors as $error){
            echo '<p class="form-error">'. $error .'</p>';
        }

        unset($_SESSION['errors_auction_create']);
    }else if(isset($_GET["create"]) && $_GET["create"]==="success"){
        echo '<p class="form-success" style="margin-bottom: 0px;">Pomyślnie utworzono licytacje!</p></br>
        <a href="index.php" style="display: block; text-align: center; justify-content: center; color: black; font-weight: bold; margin-bottom: 15px;">Wróć na stronę główną</a>';
    }
}
