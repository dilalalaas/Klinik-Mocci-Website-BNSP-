<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
include '../config/koneksi.php';

$id = $_GET['id'];
$layanan = mysqli_query($conn, "SELECT * FROM tb_layanan WHERE layanan_id='$id'");
$data = mysqli_fetch_assoc($layanan);

if (isset($_POST['update'])) {
    $nama     = $_POST['nama'];
    $harga    = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    $status   = $_POST['status'];

    $update = mysqli_query($conn, "UPDATE tb_layanan SET 
        nama_layanan='$nama', 
        harga_layanan='$harga',
        deskripsi_layanan='$deskripsi',
        status='$status'
        WHERE layanan_id='$id'");

    if ($update) {
        echo "<script>alert('Data berhasil diperbarui'); window.location='dashboard.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Layanan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h4>Edit Layanan</h4>
    <form method="POST">
        <div class="mb-3">
            <label>Nama Layanan</label>
            <input type="text" name="nama" value="<?= $data['nama_layanan'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Harga (Rp)</label>
            <input type="number" name="harga" value="<?= $data['harga_layanan'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="3"><?= $data['deskripsi_layanan'] ?></textarea>
        </div>
        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-select">
                <option value="disetujui" <?= $data['status'] == 'disetujui' ? 'selected' : '' ?>>Disetujui</option>
                <option value="tidak_disetujui" <?= $data['status'] == 'tidak_disetujui' ? 'selected' : '' ?>>Tidak Disetujui</option>
            </select>
        </div>
        <button type="submit" name="update" class="btn btn-primary">Perbarui</button>
        <a href="dashboard.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
