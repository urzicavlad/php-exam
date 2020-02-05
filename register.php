<?php
include "config.php";

define('SITE_ROOT', realpath(dirname(__FILE__)));

if (isset($_POST['submit']) && isset($_FILES['image']['name'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $encrypted_pass = password_hash($password, PASSWORD_DEFAULT);
    $sex = $_POST['gender'];
    $status = $_POST['marital'];
    $profilePhotoImageName = $_FILES['image']['name'];
    $profilePhotoExtension = strtolower(pathinfo($profilePhotoImageName, PATHINFO_EXTENSION));
    $tempFile = $_FILES['image']['tmp_name'];
    $target = __DIR__ . '/uploads/' . $username . '.' . $profilePhotoExtension;
    $extensions = ['jpg', 'png', 'jpeg','gif'];

    if (!in_array($profilePhotoExtension, $extensions)){
        echo 'Invalid photo format!';
        header("Location: error.html");
        return;
    }

    if ($username != '' && $password != '' && !empty($profilePhotoImageName)) {
        $now = date("Y/m/d");
        $query = "INSERT INTO users (firstname, lastname, email, username, password, sex, maritalstatus, profilephoto,registerDate, ext) 
VALUES ('$firstname', '$lastname', '$email', '$username', '$encrypted_pass', '$sex', '$status', '$target', '$now', '$profilePhotoExtension')";
        if (mysqli_query($connection, $query)) {
            echo "Records inserted successfully.";
        } else {
            echo "ERROR: Could not able to execute $query. " . mysqli_error($connection);
        }

        if (move_uploaded_file($tempFile, $target)) {
            echo "Uploaded";
            header("Location: index.html");
        } else {
            echo "File was not uploaded";
            header("Location: error.html");
        }

    } else {
        header("Location: error.html");
    }
}

mysqli_close($connection);
