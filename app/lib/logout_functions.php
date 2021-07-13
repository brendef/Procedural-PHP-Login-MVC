<?php 

// Log out function 
function logout() {
    session_start();
    session_unset();
    session_destroy();

    header('Location:/');
}