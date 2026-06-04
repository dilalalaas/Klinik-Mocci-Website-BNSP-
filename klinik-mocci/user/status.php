<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
include '../config/koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Status Pemesanan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body style="background-color: #ffe6f0;" class="d-flex flex-column min-vh-100"> <!-- 🌸 background pink muda -->

<!-- Navbar User -->
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: rgb(250, 22, 239);">
  <div class="container">
    <a class="navbar-brand" href="dashboard.php">User Klinik Mocci</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarUser">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarUser">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : '' ?>" href="dashboard.php">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'riwayat.php' ? 'active' : '' ?>" href="riwayat.php">Riwayat Pemesanan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'status.php' ? 'active' : '' ?>" href="status.php">Status Pemesanan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>


<!-- Riwayat -->
<!-- Konten Status Pemesanan -->
<div class="container mt-5">
    <h4>Status Pemesanan Kamu</h4>
    <table class="table table-bordered bg-white">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Layanan</th>
                <th>Tanggal Pesan</th>
                <th>Jam Pesan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $user_id = $_SESSION['user_id'];
            $status = mysqli_query($conn, "
                SELECT p.*, l.nama_layanan 
                FROM tb_pemesanan p
                JOIN tb_layanan l ON p.layanan_id = l.layanan_id
                WHERE p.user_id = '$user_id'
                ORDER BY p.tanggal_pesan DESC
            ");
            while ($data = mysqli_fetch_assoc($status)) {
                $tanggal = date('Y-m-d', strtotime($data['tanggal_pesan']));
                $jam = date('H:i:s', strtotime($data['tanggal_pesan']));
                $badge = $data['status_pemesanan'] == 'disetujui' ? 'success' : ($data['status_pemesanan'] == 'ditolak' ? 'danger' : 'warning');
                echo "<tr>
                    <td>" . $no++ . "</td>
                    <td>{$data['nama_layanan']}</td>
                    <td>{$tanggal}</td>
                    <td>{$jam}</td>
                    <td><span class='badge bg-$badge'>{$data['status_pemesanan']}</span></td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</div>


<!-- Footer -->
  <footer class="py-4 text-center text-white mt-auto" style="background-color: rgb(250, 22, 239);">
      <div class="container">
          <p class="mb-1"><i class="bi bi-geo-alt-fill me-2"></i><strong>Alamat:</strong> Jl. Cantik No. 1, Depok</p>
          <p class="mb-1"><i class="bi bi-telephone-fill me-2"></i><strong>Kontak:</strong> 0813-8726-9994</p>
          <p class="mb-0"><i class="bi bi-envelope-fill me-2"></i><strong>Email:</strong> info@moccibeauty.com</p>
      </div>
  </footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

