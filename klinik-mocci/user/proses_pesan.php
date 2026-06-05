<?php
session_start();
include '../config/koneksi.php';

if (!isset($_SESSION['user_id']) || !isset($_POST['layanan_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$layanan_id = $_POST['layanan_id'];
$tanggal = date("Y-m-d H:i:s");

$query = mysqli_query($conn, "INSERT INTO tb_pemesanan (user_id, layanan_id, tanggal_pesan, status_pemesanan) VALUES ('$user_id', '$layanan_id', '$tanggal', 'menunggu')");

if ($query) {
    echo "<script>
        alert('Layanan pemesanan anda berhasil');
        window.location='riwayat.php';
    </script>";
} else {
    echo "<script>alert('Gagal memesan layanan'); window.location='dashboard.php';</script>";
}
