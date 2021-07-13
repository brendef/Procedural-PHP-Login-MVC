<?php
// Functions related to login_model.php
include($config['LIB_PATH'] . 'login_functions.php');

// Returns the relevant error associated with $_GET['error'] in header of page
function getLoginError() {
    if (isset($_GET['error'])) {
        switch ($_GET['error']) {
            case 'emptyInputs':
                return "All fields must be completed";
                break;
            case 'userDoesNotExist':
                return "The username/email you entered does not exist";
                break;
            case 'passwordIsIncorrect':
                return "The password you entered is incorrect";
                break; 
            default:
                return "No error";
                break;           
        }
    }
}

// Handles code once login button on login page has been clicked
if (isset($_POST['login_submit'])) {
    $user = $_POST['user']; // Stores either the user's username or the users email address 
    $password = $_POST['password']; // Stores the user's password (unhashed)

    // calls function from "login_functions.php"
    if(checkForEmptyInputsInLogin($user, $password) !== false){
        header("Location:?page=login&error=emptyInputs");
        exit();
    }

    loginUser($connection, $user, $user, $password);
}