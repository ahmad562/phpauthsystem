<?php
$host = 'localhost';
$dbname = 'authtask';
$username = 'root';
$password = '';

$connection = mysqli_connect($host, $username, $password, $dbname);
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>