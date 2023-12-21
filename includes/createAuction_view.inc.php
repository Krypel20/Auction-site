<?php
declare(strict_types= 1);

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

//przeniesienie uzytkownika na strone logowania gdy jest niezalogowany
function is_user_logged_in() 
{
    if(!isset($_SESSION['user_id'])){
        $time = new DateTime();
        $newtime = $time->Modify("+2 seconds");
        header("location:login.php");
    }
}

//wyswietanie błędów przy tworzeniu rejestracji
function displayAuctionCreationMessage() {
    if (isset($_GET['create']) && $_GET['create'] === 'success') {
        echo '<div class="success-message" style="padding-bottom:10px; color:green;">Aukcja została pomyślnie utworzona!</div>';
    }
}

