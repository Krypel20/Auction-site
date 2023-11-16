<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $email = $_POST["email"];
    $confirm_pwd = $_POST["confirm_pwd"];


    try {
        require_once 'dbh.inc.php';
        require_once 'signup_model.inc.php';
        require_once 'signup_contr.inc.php';

        //Obsluga bledow przy rejestracji
        $errors = [];
        if(is_input_empty($username, $pwd, $email)){
            $errors["empty_input"] = "Wypełnij wszystkie pola";
        }
        if(is_email_invalid($email) && !is_input_empty($username, $pwd, $email)){
            $errors["invalid_email"] = "Niepoprawny adres email";
        }
        if(!are_passwords_thesame($pwd, $confirm_pwd) && !is_input_empty($username, $pwd, $email)){
            $errors["unmatched_passwords"] = "Hasła są niezgodne!";
        }
        if(is_username_taken($pdo, $username) && !is_input_empty($username, $pwd, $email)){
            $errors["username_taken"] = "Wybrana nazwa jest zajęta";
        }
        if(is_email_registered($pdo, $username) && !is_input_empty($username, $pwd, $email)){
            $errors["email_used"] = "Wybrany email jest zarejestrowany";
        }

        require_once "config_session.inc.php";

        if($errors){
            $_SESSION["errors_signup"] = $errors; //wyświetlanie informacji o błędach
            header("Location: ../signup.php");
            die();
        }

        create_user($pdo, $username, $pwd, $email); //wysłanie prawidłowych danych do bazy danych
        header("Location: ../signup.php?signup=success");

        $pdo = null;
        $stmt = null;
        die();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }    
} else { 
    header("Location: ../register.php");
    exit();
}
