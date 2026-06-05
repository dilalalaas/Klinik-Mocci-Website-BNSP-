<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
include '../config/koneksi.php';

$id = $_GET['id'];
$hapus = mysqli_query($conn, "DELETE FROM tb_layanan WHERE layanan_id='$id'");

if ($hapus) {
    echo "<script>alert('Layanan berhasil dihapus'); window.location='dashboard.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus layanan'); window.location='dashboard.php';</script>";
}
?>
