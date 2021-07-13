<?php

function checkForEmptyInputsInLogin($user, $password){ 
    if(empty($user) || empty($password)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

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