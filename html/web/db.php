<?php
$conn = new mysqli("10.20.30.1", "pi", "pi", "pi");
mysqli_set_charset($conn, "utf8");
// Check connection
if ($conn->connect_error) {
    die("DB Connection failed: " . $conn->connect_error);
}
?>
