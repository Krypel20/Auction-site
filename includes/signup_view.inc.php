<?php
    
declare(strict_types= 1);

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

// function signup_inputs()
// {
    
//     if(isset($_SESSION["signup_data"]["username"]) && !isset($_SESSION["errors_signup"]["username_taken"])){
//         echo '
//         <div class="input-group">
//             <label for="username">Nazwa użytkownika</label>
//             <input type="text" id="username" name="username" placeholder="Nazwa użytkownika" value="'. $_SESSION["signup_data"]["username"] .'">
//         </div>';
//     }else {
//         echo '
//         <div class="input-group">
//             <label for="username">Nazwa użytkownika</label>
//             <input type="text" id="username" name="username" placeholder="Nazwa użytkownika">
//         </div>';
//     }

//     echo '
//     <div class="input-group">
//         <label for="password">Hasło</label>
//         <input type="password" id="password" name="pwd" placeholder="Hasło">
//     </div>';

//     // Z email to samo co z username...
// }
