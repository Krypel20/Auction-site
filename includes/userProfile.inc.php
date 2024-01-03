<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userID = $_SESSION['user_id'];
    $pwd = $_POST["new-password"];
    $oldPwd = $_POST["old-password"];
    $confirmPwd = $_POST["confirm-pwd"];

    try {
        require_once 'dbh.inc.php';

        //Obsluga bledow przy rejestracji
        $errors = [];
        if(is_input_empty($confirmPwd, $pwd, $oldPwd)){
            $errors["empty_input"] = "Wypełnij wszystkie pola";
        }
        elseif(!are_passwords_thesame($pwd, $confirm_pwd)){
            $errors["unmatched_passwords"] = "Hasła się nie zgadzają!";
        }

        require_once "config_session.inc.php";

        if ($errors) {
            $response = [
                'success' => false,
                'message' => implode(', ', $errors)
            ];
        } else {
            editUserPassword($pdo, $userID, $pwd);
            $response = [
                'success' => true,
                'message' => 'Hasło zostało zmienione.'
            ];
        }

        echo json_encode($response);
        exit();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }    
} else { 
    header("Location: ../userProfile.php");
    exit();
}

function editUSerPassword(object $pdo, $userID, $pwd){
    
}