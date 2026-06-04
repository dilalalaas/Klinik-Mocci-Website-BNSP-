<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
include '../config/koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - Klinik Mocci</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body style="background-color: #ffe6f0;"> <!-- 🌸 Warna pink muda -->

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark mb-4" style="background-color: rgb(250, 22, 239);">
  <div class="container">
    <a class="navbar-brand" href="dashboard.php">Admin Klinik Mocci</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAdmin">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAdmin">
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

<div class="container mt-5">
    <h3>Halo, Admin 👋</h3>
    <a href="tambah_layanan.php" class="btn btn-success btn-sm mb-3">+ Tambah Layanan</a>
    <a href="logout.php" class="btn btn-danger btn-sm mb-3 float-end">Logout</a>

    <table class="table table-bordered table-striped bg-white">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Layanan</th>
                <th>Harga Layanan</th>
                <th>Status</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $layanan = mysqli_query($conn, "SELECT * FROM tb_layanan");
            while ($row = mysqli_fetch_assoc($layanan)) {
                $gambar = !empty($row['gambar_layanan']) ? '../uploads/' . $row['gambar_layanan'] : 'https://via.placeholder.com/100';

                echo "<tr>
                    <td>" . $no++ . "</td>
                    <td>{$row['nama_layanan']}</td>
                    <td>Rp " . number_format($row['harga_layanan'], 0, ',', '.') . "</td>
                    <td>{$row['status']}</td>
                    <td><img src='$gambar' width='80' height='60' style='object-fit:cover;'></td>
                    <td>
                        <a href='edit_layanan.php?id={$row['layanan_id']}' class='btn btn-warning btn-sm'>Edit</a>
                        <a href='hapus_layanan.php?id={$row['layanan_id']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Hapus layanan ini?')\">Hapus</a>
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
