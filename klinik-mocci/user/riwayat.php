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
    <title>Riwayat Pemesanan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }
        main {
            flex: 1;
        }
    </style>
</head>
<body style="background-color: #ffe6f0;">

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
          <a class="nav-link" href="dashboard.php">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="riwayat.php">Riwayat Pemesanan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="status.php">Status Pemesanan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<main class="container mt-5">
    <h4>Riwayat Pemesanan</h4>

    <!-- Alert jika pesan sukses -->
    <?php if (isset($_GET['pesan']) && $_GET['pesan'] == 'sukses'): ?>
      <div class="alert alert-success text-center">
        🎉 Layanan berhasil dipesan!
      </div>
    <?php endif; ?>

    <table class="table table-bordered bg-white">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama User</th>
                <th>Email</th>
                <th>Nama Layanan</th>
                <th>Harga Layanan</th>
                <th>Tanggal Pesan</th>
                <th>Jam Pesan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $user_id = $_SESSION['user_id'];
            $riwayat = mysqli_query($conn, "
                SELECT p.tanggal_pesan, l.nama_layanan, l.harga_layanan, u.nama, u.email
                FROM tb_pemesanan p
                JOIN tb_layanan l ON p.layanan_id = l.layanan_id
                JOIN tb_user u ON p.user_id = u.user_id
                WHERE p.user_id = '$user_id'
                ORDER BY p.tanggal_pesan DESC
            ");
            while ($data = mysqli_fetch_assoc($riwayat)) {
                $tanggal = date('Y-m-d', strtotime($data['tanggal_pesan']));
                $jam = date('H:i:s', strtotime($data['tanggal_pesan']));
                echo "<tr>
                    <td>" . $no++ . "</td>
                    <td>{$data['nama']}</td>
                    <td>{$data['email']}</td>
                    <td>{$data['nama_layanan']}</td>
                    <td>Rp " . number_format($data['harga_layanan'], 0, ',', '.') . "</td>
                    <td>{$tanggal}</td>
                    <td>{$jam}</td>
                </tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Tombol ke Status Pemesanan -->
    <div class="text-center mt-4">
        <a href="status.php" class="btn btn-outline-primary">
            🔍 Lihat Status Pemesanan di sini
        </a>
    </div>
</main>

<!-- Footer -->
<footer class="py-4 text-center text-white" style="background-color: rgb(250, 22, 239);">
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
