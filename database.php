<?php
$hostname = 'localhost'; // Replace with your database hostname
$username = 'root'; // Replace with your database username
$password = ''; // Replace with your database password
$database = 'echarge'; // Replace with your database name

$connection = new mysqli($hostname, $username, $password, $database);

// Check if the connection was successful
if ($connection->connect_error) {
    die('Database connection failed: ' . $connection->connect_error);
}
