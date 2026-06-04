<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
include '../config/koneksi.php';

// Proses setujui / tolak
if (isset($_GET['aksi']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $status = ($_GET['aksi'] == 'setujui') ? 'disetujui' : 'ditolak';
    mysqli_query($conn, "UPDATE tb_pemesanan SET status_pemesanan='$status' WHERE pemesanan_id='$id'");
    header("Location: pemesanan.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pemesanan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body style="background-color: #ffe6f0;"> <!-- 🌸 background pink muda -->

<!-- ✅ Navbar Admin -->
<nav class="navbar navbar-expand-lg navbar-dark mb-4" style="background-color: rgb(250, 22, 239);">
  <div class="container">
    <a class="navbar-brand" href="dashboard.php">Admin Klinik Mocci</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarAdmin">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarAdmin">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link<?= basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? ' active' : '' ?>" href="dashboard.php">Layanan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link<?= basename($_SERVER['PHP_SELF']) == 'pemesanan.php' ? ' active' : '' ?>" href="pemesanan.php">Pemesanan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- ✅ Konten -->
<div class="container mt-5">
    <h3>Daftar Pemesanan User</h3>

    <table class="table table-bordered table-striped bg-white">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama User</th>
                <th>Nama Layanan</th>
                <th>Tanggal Pesan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        $query = mysqli_query($conn, "
            SELECT p.pemesanan_id, u.nama AS nama_user, l.nama_layanan, p.tanggal_pesan, p.status_pemesanan 
            FROM tb_pemesanan p 
            JOIN tb_user u ON p.user_id = u.user_id 
            JOIN tb_layanan l ON p.layanan_id = l.layanan_id 
            ORDER BY p.tanggal_pesan DESC
        ");
        while ($row = mysqli_fetch_assoc($query)) {
            echo "<tr>
                <td>" . $no++ . "</td>
                <td>{$row['nama_user']}</td>
                <td>{$row['nama_layanan']}</td>
                <td>{$row['tanggal_pesan']}</td>
                <td><span class='badge bg-" . 
                    ($row['status_pemesanan'] == 'disetujui' ? 'success' : 
                    ($row['status_pemesanan'] == 'ditolak' ? 'danger' : 'warning')) . "'>
                    {$row['status_pemesanan']}
                </span></td>
                <td>
                    <a href='pemesanan.php?aksi=setujui&id={$row['pemesanan_id']}' class='btn btn-success btn-sm'>Setujui</a>
                    <a href='pemesanan.php?aksi=tolak&id={$row['pemesanan_id']}' class='btn btn-danger btn-sm'>Tolak</a>
                </td>
            </tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
