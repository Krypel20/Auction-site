<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pwd = $_POST["pwd"];
    $email = $_POST["email"];

    try {
        require_once 'dbh.inc.php';
        require_once 'login_model.inc.php';
        require_once 'login_contr.inc.php';

        //Obsluga bledow przy rejestracji
        $errors = [];
        if(is_input_empty($pwd, $email)){
            $errors["empty_input"] = "Wypełnij wszystkie pola";
        }
        
        $result = get_user($pdo, $email);

        if(is_email_wrong($result)){
            $errors["login_incorrect"] = "Niepoprawne dane logowania!";
        }
        if(!is_email_wrong($result) && is_password_wrong($pwd,$result["pwd"])){
            $errors["login_incorrect"] = "Niepoprawne dane logowania!";
        }

        require_once "config_session.inc.php";

        if($errors){
            $_SESSION["errors_login"] = $errors; //wyświetlanie informacji o błędach

            header("Location: ../login.php");
            die();
        }
        
        $newSessionId = session_create_id();
        $sessionId = $newSessionId . "_" . $result["id"];
        session_id($sessionId);

        $_SESSION["user_id"] = $result["id"];
        $_SESSION["user_username"]= htmlspecialchars($result["username"]);
        $_SESSION["user_email"] = htmlspecialchars($result["email"]);

        $_SESSION["last_regeneration"] = time();

        header("Location: ../login.php?login=success");

        $pdo = null;
        $stmt = null;
        die();
    
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }    
}else{ 
    header("Location: ../login.php");
    die();
}