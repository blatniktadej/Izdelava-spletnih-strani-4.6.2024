<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "izobrazevanje";

// Ustvari povezavo
$conn = new mysqli($servername, $username, $password, $dbname);

// Preveri povezavo
if ($conn->connect_error) {
    die("Povezava ni uspela: " . $conn->connect_error);
}
?>
