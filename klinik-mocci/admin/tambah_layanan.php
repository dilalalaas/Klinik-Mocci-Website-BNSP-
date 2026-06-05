<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
include '../config/koneksi.php';

if (isset($_POST['simpan'])) {
    $nama       = $_POST['nama'];
    $harga      = $_POST['harga'];
    $deskripsi  = $_POST['deskripsi'];
    $status     = $_POST['status'];

    // Proses upload gambar
    $gambar = $_FILES['gambar']['name'];
    $tmp    = $_FILES['gambar']['tmp_name'];

    // Folder tujuan
    $folder = '../uploads/';
    $path   = $folder . $gambar;

    if (move_uploaded_file($tmp, $path)) {
        $insert = mysqli_query($conn, "INSERT INTO tb_layanan 
        (nama_layanan, harga_layanan, deskripsi_layanan, status, gambar_layanan)
        VALUES ('$nama', '$harga', '$deskripsi', '$status', '$gambar')");

        if ($insert) {
            echo "<script>alert('Layanan berhasil ditambahkan'); window.location='dashboard.php';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan ke database');</script>";
        }
    } else {
        echo "<script>alert('Gagal upload gambar');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Layanan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h4>Tambah Layanan Baru</h4>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Nama Layanan</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Harga (Rp)</label>
            <input type="number" name="harga" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label>Gambar Layanan</label>
            <input type="file" name="gambar" class="form-control" accept="image/*" required>
        </div>
        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-select">
                <option value="disetujui">Disetujui</option>
                <option value="tidak_disetujui">Tidak Disetujui</option>
            </select>
        </div>
        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
        <a href="dashboard.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
