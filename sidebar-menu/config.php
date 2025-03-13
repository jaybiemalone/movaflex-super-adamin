<?php
$servername = "localhost"; // Change if using a different host
$username = "root"; // Change if using a different username
$password = ""; // Change if using a different password
$dbname = "movaflex"; // Change to your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
