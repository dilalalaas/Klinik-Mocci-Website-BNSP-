<?php
include('../config/koneksi.php');
$id = $_GET['id'];
mysqli_query($conn, "UPDATE layanan SET status = 'disetujui' WHERE id = $id");
header("Location: dashboard.php");
?>