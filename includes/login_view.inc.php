<?php

declare(strict_types=1);

function output_username()
{
    if(isset($_SESSION["user_id"])){
        echo "Jesteś zalogowany jako " . $_SESSION ["user_username"];
    }else{
        echo "Logowanie";
    }
}

function check_login_errors()
{
    if(isset($_SESSION['errors_login'])){
        $errors = $_SESSION['errors_login'];

        foreach($errors as $error){
            echo '<p class="form-error">'. $error .'</p>';
        }

        unset($_SESSION['errors_login']);
    }else if(isset($_GET["login"]) && $_GET["login"]==="success"){
        echo '<p class="form-success">Pomyślnie zalogowano!</p></br>
        <a id="link" href="index.php">Powrót na stronę główną</a>';
    }
}