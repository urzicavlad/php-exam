<?php
include "config.php";
session_start();


if (!empty($_POST)) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $_SESSION['orderBy'] = $_POST['orderBy'];

    if (isset($_POST['username']) && isset($_POST['password'])) {
        $getUserByUserNameQuery = "SELECT * FROM users WHERE username = '$username'";
        $stmt = $connection->prepare($getUserByUserNameQuery);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_object();
        if (password_verify($password, $user->password)) {
            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_password'] = $user->password;
            header("Location: landingPage.html");
        }else{
            $_SESSION['error_message'] = 'Parola nu este corecta!';
            header("Location: error.html");
        }
    } 
}
mysqli_close($connection);

