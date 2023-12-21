<?php
    
declare(strict_types= 1);
//funkcje odpowiedzialne za wyswietlanie błedów

function check_signup_errors()
{
    if(isset($_SESSION['errors_signup'])){
        $errors = $_SESSION['errors_signup'];

        foreach($errors as $error){
            echo '<p class="form-error">'. $error .'</p>';
        }

        unset($_SESSION['errors_signup']);
    }else if(isset($_GET["signup"]) && $_GET["signup"]==="success"){
        echo '<p class="form-success" style="margin-bottom: 0px;">Pomyślnie zarejestrowano!</p></br>
        <a href="index.php" style="display: block; text-align: center; justify-content: center; color: black; font-weight: bold; margin-bottom: 15px;">Wróć na stronę główną</a>';
    }
}
