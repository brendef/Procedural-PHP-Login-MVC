<?php 
// Functions related to register_model.php
include($config['LIB_PATH'] . 'register_functions.php');

// Returns the relevant error associated with $_GET['error'] in header of page
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

/* 
* Handles code when register form gets submitted 
* Set all header locations to relevant existing pages
*/
if (isset($_POST['register_submit'])) {
    $username = strtolower($_POST['username']);
    $email = strtolower($_POST['email']);
    $password = strtolower($_POST['password']);
    $confirmPassword = strtolower($_POST['confirm_password']);

    // Function called from the "register_functions.php" file
    if(checkForEmptyInputsInRegister($username, $email, $password, $confirmPassword) !== false){
        header("Location:?page=register&error=emptyInputs");
        exit();
    }

    // Function called from the "register_functions.php" file
    if(checkForValidUsername($username) !== false){
        header("Location:?page=register&error=invalidUsername");
        exit();
    }

    // Function called from the "register_functions.php" file
    if(checkForInvalidEmailAddress($email) !== false){
        header("Location:?page=register&error=invalidEmailAddress");
        exit();
    }

    // Function called from the "register_functions.php" file
    if(checkIfPasswordsMatch($password, $confirmPassword) !== false){
        header("Location:?page=register&error=passwordsDoNotMatch");
        exit();
    }

    // Function called from the "register_functions.php" file
    if(checkIfUsernameExists($connection, $username) !== false){
        header("Location:?page=register&error=usernameTaken");
        exit();
    }

    // Function called from the "register_functions.php" file
    if(checkIfEmailAddressExists($connection, $email) !== false){
        header("Location:?page=register&error=emailTaken");
        exit();
    }
    
    // Function called from the "register_functions.php" file
    createUser($connection, $username, $email, $password);
    
} 