<?php
session_start();
include '../config/koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['konfirmasi'])) {
    $user_id = $_SESSION['user_id'];
    $layanan_id = $_POST['layanan_id'];
    $tanggal = date('Y-m-d H:i:s');

    $insert = mysqli_query($conn, "INSERT INTO tb_pemesanan (user_id, layanan_id, tanggal_pesan, status_pemesanan) 
                VALUES ('$user_id', '$layanan_id', '$tanggal', 'menunggu')");

    if ($insert) {
        header("Location: riwayat.php?pesan=sukses");
    } else {
        echo "<script>alert('Gagal melakukan pemesanan'); window.location='dashboard.php';</script>";
    }
    exit;
}
?>
