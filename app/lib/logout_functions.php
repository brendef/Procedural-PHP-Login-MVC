<?php 

// Log out function 
function logout() {
    // Start the session for incase a session wasn't started (preventative measure)
    session_start();
    // Remove any global variables associated with the session
    session_unset();
    // End the session
    session_destroy();

    // Go to root directory 
    header('Location:/');
}