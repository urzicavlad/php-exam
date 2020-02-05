<?php
$connection = mysqli_connect("localhost", "root", "", "users");

$sql = "CREATE TABLE users (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
firstname VARCHAR(50) NOT NULL,
lastname VARCHAR(50) NOT NULL,
email VARCHAR(50) NOT NULL,
username VARCHAR(30) NOT NULL,
password VARCHAR(100) NOT NULL,
sex VARCHAR(50) NOT NULL,
maritalstatus VARCHAR(50) NOT NULL,
profilephoto longtext NOT NULL,
registerDate DATE NOT NULL,
ext varchar(10) NOT NULL
)";

if ($connection->query($sql) === TRUE) {
    echo "Table users created successfully!";
} else {
    echo "Error creating table: " . $connection->error;
}

$connection->close();
