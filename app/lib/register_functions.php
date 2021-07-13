<?php

/*
* Check for empty inputs :
* 1. To add more inputs enter the data inputed into the relevant intput variables in the signature of the function
* 2. Add the "empty()" function to the if statement with the relevant variable in its signature
*/
function checkForEmptyInputsInRegister($username, $email, $password, $confirmPassword){ 
    if(empty($username) || empty($email) || empty($password) || empty($confirmPassword)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

/*
* Check for valid username : (returns true if username is valid)
* 1. Enter the username in the function signature
* 2. function will look for characters specified in the preg_match and will return false if other characters exist
* 3. Adjust regular expression to adjust what constitutes a valid username
*/
function checkForValidUsername($username){ 
    if(!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

/*
* Check for valid email address : (returns true if email is valid)
* 1. Enter the email address in the function signature
* 2. Function uses PHP built in funciton to verify if email address is valid.
*/
function checkForInvalidEmailAddress($email){ 
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

/*
* Check if both passwords match :
* 1. Enter the both passwords in the function signature
* 2. function will compare both passwords with a ==
* 3. returns true if passwords match
*/
function checkIfPasswordsMatch($password, $confirmPassword){ 
    if($password !== $confirmPassword) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

/*
* Check for username in database :
* 1. Enter the database connection and username in the function signature
* 2. Set field names and table to match relevant database field names and table
* 3. Set header location to relevant page
*/
function checkIfUsernameExists($connection, $username){ 
    $sql = "SELECT * FROM users WHERE users_username = ?;";
    $stmt = mysqli_stmt_init($connection);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header('Location:?page=register&error=usernameStatementFailed');
        exit();
    } 

    mysqli_stmt_bind_param($stmt, "s", $username);
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
* Check for email in database :
* 1. Enter the database connection and email address in the function signature
* 2. Set field names and table to match relevant database field names and table
* 3. Set header location to relevant page
*/
function checkIfEmailAddressExists($connection, $email){ 
    $sql = "SELECT * FROM users WHERE users_email = ?;";
    $stmt = mysqli_stmt_init($connection);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header('Location:?page=register&error=emailStatementFailed');
        exit();
    } 

    mysqli_stmt_bind_param($stmt, "s", $email);
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
* Insert user into database :
* 1. Enter the database connection and username, email and password in the function signature
* 2. Set field names and table to match relevant database field names and table
* 3. Set header location to relevant page
*/
function createUser($connection, $username, $email, $password){ 
    $sql = "INSERT INTO users (users_email, users_username, users_password) VALUES (?, ?, ?);";
    $stmt = mysqli_stmt_init($connection);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header('Location:?page=register&error=userStatementFailed');
        exit();
    } 

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sss", $email, $username, $hashedPassword);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    // calls function to log user in from the "login_functions.php" file
    include($config['LIB_PATH'] . 'login_functions.php');
    loginUser($connection, $username, $email, $password);
    header('Location:?page=home');
    exit();
}
