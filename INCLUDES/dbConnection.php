<?php
// Kapcsolódás az adatbázishoz
$servername = "localhost";
$username = "root";
$password = "";
$database = "elfelejtett";

$conn = new mysqli($servername, $username, $password, $database);

// Kapcsolódás ellenőrzése
if ($conn->connect_error) {
    die("Sikertelen kapcsolódás: " . $conn->connect_error);
}
?>