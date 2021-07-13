<?php

function checkForEmptyInputsInRegister($username, $email, $password, $confirmPassword){ 
    if(empty($username) || empty($email) || empty($password) || empty($confirmPassword)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function checkForValidUsername($username){ 
    if(!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function checkForInvalidEmailAddress($email){ 
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function checkIfPasswordsMatch($password, $confirmPassword){ 
    if($password !== $confirmPassword) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

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

    include($config['LIB_PATH'] . 'login_functions.php');
    loginUser($connection, $username, $email, $password);
    header('Location:?page=home');
    exit();

}
?>