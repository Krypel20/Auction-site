<?php
declare(strict_types= 1);

//przeniesienie uzytkownika na strone logowania gdy jest niezalogowany
function is_user_logged_in() 
{
    if(!isset($_SESSION['user_id'])){
        $time = new DateTime();
        $newtime = $time->Modify("+2 seconds");
        header("location:login.php");
    }
}

//wyswietanie komunikatów przy tworzeniu rejestracji
function displayAuctionMessage() {
    if (isset($_GET['create']) && $_GET['create'] === 'success') {
        echo '<div class="success-message" style="padding-bottom:10px; font-size: 17px; color:green; font-weight:bold;">Aukcja została pomyślnie utworzona!</div>';
    }
    if (isset($_GET['create']) && $_GET['create'] === 'error') {
        echo '<div class="error-message" style="padding-bottom:10px; font-size: 17px; color:red; font-weight:bold;">Nie podano wszystkich danych!</div>';
    }
}

function Categories(){

    $categories = [
        'Zdrowie i Uroda',
        'Telefony i Akcesoria',
        'Sztuka',
        'Sprzęt AGD',
        'Sport i Fitness',
        'Motoryzacja',
        'Moda',
        'Meble',
        'Książki i Edukacja',
        'Instrumenty Muzyczne',
        'Gry i Konsole',
        'Fotografia',
        'Elektronika',
        'Dom i Ogród',
        'Biżuteria i Zegarki',
        'Antyki',
    ];

    foreach ($categories as $category) {
        echo "<option value=\"$category\">$category</option>";
    }
}