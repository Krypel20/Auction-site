<?php

ini_set("session.use_only_cookies", 1);
ini_set("session.use_only_mode", 1);

// Konfiguracja ciasteczka sesji
session_set_cookie_params([
    'lifetime' => 1800,         // Czas trwania sesji w sekundach (1800 sekund = 30 minut)
    'domain' => 'localhost',    // Domena, dla której ciasteczko jest dostępne
    'path' => '/',              // Ścieżka na serwerze, dla której ciasteczko jest dostępne
    'secure' => true,           // Wymusza użycie protokołu HTTPS
    'httponly' => true          // Uniemożliwia dostęp do ciasteczka przez skrypt JS
]);

session_start();

// Sprawdzenie czy użytkownik jest zalogowany
if(isset($_SESSION["user_id"])){
    // Sprawdzenie czy istnieje ostatnie odnowienie sesji
    if(!isset($_SESSION["last_regeneration"])) {
        // Jeśli nie istnieje, odnowienie sesji
        regenerate_session_id_loggedin();
    } else {
        // Jeśli istnieje, sprawdzenie czasu od ostatniego odnowienia
        $interval = 60 * 30; // 30 minut
        if(time() - $_SESSION["last_regeneration"] >= $interval){
            // Jeśli upłynął określony czas, odnowienie sesji
            regenerate_session_id_loggedin();
        }
    }
} else {
    // Jeśli użytkownik nie jest zalogowany
    if(!isset($_SESSION["last_regeneration"])) {
        // Jeśli nie istnieje ostatnie odnowienie sesji, odnowienie sesji
        regenerate_session_id();
    } else {
        // Jeśli istnieje ostatnie odnowienie sesji, sprawdzenie czasu od ostatniego odnowienia
        $interval = 60 * 30; // 30 minut
        if(time() - $_SESSION["last_regeneration"] >= $interval){
            // Jeśli upłynął określony czas, odnowienie sesji
            regenerate_session_id();
        }
    }
}

// Funkcja do odnowienia sesji
function regenerate_session_id(){
    session_regenerate_id(true);
    $_SESSION["last_regeneration"] = time();
}

// Funkcja do odnowienia sesji dla zalogowanego użytkownika
function regenerate_session_id_loggedin(){
    session_regenerate_id(true);

    // Pobranie identyfikatora użytkownika
    $userId = $_SESSION["user_id"];
    
    // Utworzenie nowego identyfikatora sesji
    $newSessionId = session_create_id();
    
    // Połączenie nowego identyfikatora sesji z identyfikatorem użytkownika
    $sessionId = $newSessionId . "_" . $userId;
    
    // Ustawienie nowego identyfikatora sesji
    session_id($sessionId);

    // Zapisanie czasu ostatniego odnowienia sesji
    $_SESSION["last_regeneration"] = time();
}
