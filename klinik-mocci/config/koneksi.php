<?php
// config/koneksi.php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "klinik-mocci";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
