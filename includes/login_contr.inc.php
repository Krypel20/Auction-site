<?php
declare(strict_types=1);
//funkcje odpowiedzialne za kontrolę formularza

function login_user(string $pwd, string $email){
    if(search_user($email, $pwd)){
        return true;
    }else{
        return false;
    }
}
