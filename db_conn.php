<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "notepad";
$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Błąd połączenia: " . $conn->connect_errno . " " . $conn->connect_error);
}
?>