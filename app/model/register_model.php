<?php 
// Functions related to register_model.php
include($config['LIB_PATH'] . 'register_functions.php');

function getRegisterError() {
    if (isset($_GET['error'])) {
        switch ($_GET['error']) {
            case 'emptyInputs':
                return "All fields must be completed";
                break;
            case 'invalidUsername':
                return "The username you have entered is invalid";
                break;
            case 'invalidEmailAddress':
                return "The email address you have entered is invalid";
                break;
            case 'passwordsDoNotMatch':
                return "Passwords do not match";
                break;  
            case 'usernameTaken':
                return "The username you have entered has been taken";
                break;   
            case 'emailTaken':
                return "The email address you have entered is already in use";
                break;    
            case 'usernameStatementFailed':
                return "Something went wrong, please try again";
                break;   
            case 'emailStatementFailed':
                return "Something went wrong, please try again";
                break;  
            case 'userStatementFailed':
                return "Something went wrong, please try again";
                break;
            default:
                return "No error";
                break;            
        }
    }
}

// Handles code when register form gets submitted
if (isset($_POST['register_submit'])) {
    $username = strtolower($_POST['username']);
    $email = strtolower($_POST['email']);
    $password = strtolower($_POST['password']);
    $confirmPassword = strtolower($_POST['confirm_password']);

    if(checkForEmptyInputsInRegister($username, $email, $password, $confirmPassword) !== false){
        header("Location:?page=register&error=emptyInputs");
        exit();
    }

    if(checkForValidUsername($username) !== false){
        header("Location:?page=register&error=invalidUsername");
        exit();
    }

    if(checkForInvalidEmailAddress($email) !== false){
        header("Location:?page=register&error=invalidEmailAddress");
        exit();
    }

    if(checkIfPasswordsMatch($password, $confirmPassword) !== false){
        header("Location:?page=register&error=passwordsDoNotMatch");
        exit();
    }

    if(checkIfUsernameExists($connection, $username) !== false){
        header("Location:?page=register&error=usernameTaken");
        exit();
    }

    if(checkIfEmailAddressExists($connection, $email) !== false){
        header("Location:?page=register&error=emailTaken");
        exit();
    }
    
    createUser($connection, $username, $email, $password);
    
} 