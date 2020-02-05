<?php
$connection = mysqli_connect("localhost", "root", "", "users");

if (!$connection) {
 die("Connection failed: " . mysqli_connect_error());
}
