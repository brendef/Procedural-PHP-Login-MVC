<?php
// Functions related to login_model.php
include($config['LIB_PATH'] . 'login_functions.php');

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

if (isset($_POST['login_submit'])) {
    $user = $_POST['user'];
    $password = $_POST['password'];

    if(checkForEmptyInputsInLogin($user, $password) !== false){
        header("Location:?page=login&error=emptyInputs");
        exit();
    }

    loginUser($connection, $user, $user, $password);
}