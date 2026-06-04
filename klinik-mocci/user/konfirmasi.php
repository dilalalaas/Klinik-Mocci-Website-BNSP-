<?php
session_start();
include '../config/koneksi.php';

// Pastikan user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Proses pemesanan setelah klik "Ya, Lanjutkan"
if (isset($_POST['konfirmasi'])) {
    $user_id = $_SESSION['user_id'];
    $layanan_id = $_POST['layanan_id'];
    $tanggal = date('Y-m-d H:i:s');

    $insert = mysqli_query($conn, "INSERT INTO tb_pemesanan (user_id, layanan_id, tanggal_pesan, status_pemesanan) 
                VALUES ('$user_id', '$layanan_id', '$tanggal', 'menunggu')");

    if ($insert) {
        // Redirect untuk menghindari form resubmission
        header("Location: riwayat.php?pesan=sukses");
        exit;
    } else {
        echo "<script>alert('Gagal melakukan pemesanan'); window.location='dashboard.php';</script>";
        exit;
    }
}

// Jika belum ada layanan_id yang dikirim, kembalikan ke dashboard
if (!isset($_POST['layanan_id'])) {
    header("Location: dashboard.php");
    exit;
}

// Ambil data user & layanan untuk ditampilkan
$user_id = $_SESSION['user_id'];
$layanan_id = $_POST['layanan_id'];

$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_user WHERE user_id='$user_id'"));
$layanan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_layanan WHERE layanan_id='$layanan_id'"));
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Konfirmasi Pemesanan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body style="background-color: #ffe6f0;">
<div class="container mt-5">
    <div class="card shadow p-4">
        <h4 class="text-center mb-4">Konfirmasi Pemesanan</h4>
        <p><strong>Nama:</strong> <?= $user['nama'] ?></p>
        <p><strong>Email:</strong> <?= $user['email'] ?></p>
        <p><strong>Layanan:</strong> <?= $layanan['nama_layanan'] ?></p>
        <p><strong>Harga:</strong> Rp <?= number_format($layanan['harga_layanan'], 0, ',', '.') ?></p>

        <form action="konfirmasi.php" method="POST" class="mt-4">
            <input type="hidden" name="layanan_id" value="<?= $layanan['layanan_id'] ?>">
            <button type="submit" name="konfirmasi" class="btn btn-success">Ya, Lanjutkan</button>
            <a href="dashboard.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
</body>
</html>
