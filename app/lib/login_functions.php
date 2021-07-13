<?php


/*
* Check for empty inputs :
* 1. To add more inputs enter the data inputed into the relevant intput variables in the signature of the function
* 2. Add the "empty()" function to the if statement with the relevant variable in its signature
*/
function checkForEmptyInputsInLogin($user, $password){ 
    if(empty($user) || empty($password)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

/*
* Fetch user information from database :
* 1. Adjust the fields eg. "users_username" or "users_email" to match the database
* 2. Set header location to existing relevant page in web app
*/
function getUserData($connection, $username, $email) {
    $sql = "SELECT * FROM users WHERE users_username = ? OR users_email = ?;";
    $stmt = mysqli_stmt_init($connection);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header('Location:?page=register&error=loginStatementFailed');
        exit();
    } 

    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    } else {
        $result = false;
    }
    return $result;

    mysqli_stmt_close($stmt);
}

/*
* Log the user into the application :
* 1. Enter all username and password field rename the fields in "$userData['']" to match your database
* 2. Set header location to existing relevant page in web app
* 3. (Enter the unhashed password)
*/
function loginUser($connection, $username, $email, $password) {
    $userData = getUserData($connection, $username, $email);

    if($userData === false) {
        header('Location: ?page=login&error=userDoesNotExist');
        exit();
    }

    $hashedPassword = $userData['users_password'];
    $checkPassword = password_verify($password, $hashedPassword);

    if($checkPassword === false) {
        header('Location: ?page=login&error=passwordIsIncorrect');
        exit();
    } else if($checkPassword === true) {
        session_start();
        $_SESSION['users_id'] = $userData['users_id'];
        $_SESSION['users_username'] = $userData['users_username'];

        header('Location: ?page=home');
        exit();
    }
}