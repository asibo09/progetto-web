<?php
function isActive($pagename){
    if(basename($_SERVER['PHP_SELF'])==$pagename){
        echo " class='active' ";
    }
}

function getIdFromName($name){
    return preg_replace("/[^a-z]/", '', strtolower($name));
}

function registerLoggedUser($user){
    $_SESSION["email"] = $user["email"];
    $_SESSION["password"] = $user["password"];
    $_SESSION["id_utente"] = $user["id_utente"];
}

function isUserLoggedIn(){
    return !empty($_SESSION['email']);
}