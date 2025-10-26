<?php
$servername = "localhost";
$username = "jomariharvy";
$password = "Crushkosivillanueva";
$database = "hjjc";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
