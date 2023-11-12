<?php

declare(strict_types=1);

function is_user_logged_in()
{
    if(isset($_SESSION['user_id'])){
        $time = new DateTime();
        $newtime = $time->Modify("+2 seconds");
        header("location:index.php");
    }
}

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

function media_if_not_logged_in()
{
    if(!isset($_SESSION["user_id"])){
        echo '<button type="submit">Zaloguj się</button>
        <a href="#" class="reset-password">Zapomniałeś hasła?</a>
        <a href="register.php" class="register-link">Zarejestruj się</a>';
    }
}