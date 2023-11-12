<?php

function is_user_logged_in() 
{
    if(!isset($_SESSION['user_id'])){
        $time = new DateTime();
        $newtime = $time->Modify("+2 seconds");
        header("location:login.php");
    }
}