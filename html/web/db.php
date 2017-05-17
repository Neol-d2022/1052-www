<?php
$uuidFile = fopen("/var/www/uuid", "r") or die("Device UUID is not set!");
if(($uuid = fgets($uuidFile)) === false) {
    die("Cannot read uuid");
}
var_dump($uuid);

$conn = new mysqli("db", "pi", "pi", "pi");
mysqli_set_charset($conn, "utf8");
// Check connection
if ($conn->connect_error) {
    die("DB Connection failed: " . $conn->connect_error);
}
?>
