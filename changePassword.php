<?php
include 'config.php';
session_start();
$password = $_SESSION['user_password'];

if (isset($password)) {

    $oldPasswordInput = $_POST['oldPassword'];
    $newPasswordInput_A = $_POST['newPassword_A'];
    $newPasswordInput_B = $_POST['newPassword_B'];

    if (!isset($newPasswordInput_A) || !isset($newPasswordInput_B) || !isset($oldPasswordInput)){
        $_SESSION['error_message'] = 'Parolele nu sunt la fel!';
        header('Location: error.html');
        return;
    }

    if ($newPasswordInput_A != $newPasswordInput_B){
        $_SESSION['error_message'] = 'Parolele nu sunt la fel!';
        header('Location: error.html');
        return;
    }

    if (!password_verify($oldPasswordInput, $password)){
        $_SESSION['error_message'] = 'Parola veche nu este corecta!';
        header('Location: error.html');
        return;
    }

    if (password_verify($newPasswordInput_B, $password)){
        $_SESSION['error_message'] = 'Parola noua este la fel cu cea veche!';
        header('Location: error.html');
        return;
    }

    $encrypted_pass = password_hash($newPasswordInput_B, PASSWORD_DEFAULT);
    $userId = $_SESSION["user_id"];
    $query = "UPDATE users SET password = '$encrypted_pass' WHERE id = '$userId'";
    if (mysqli_query($connection, $query)) {
        header('Location: index.html');
        session_destroy();
    }
}
