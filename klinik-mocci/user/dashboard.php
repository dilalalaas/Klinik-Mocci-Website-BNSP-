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
    <title>Dashboard User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head> 

<style>
.card-hover {
  transition: all 0.3s ease;
  cursor: pointer;
}
.card-hover:hover {
  box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
  transform: scale(1.02);
}
</style>

<body style="background-color: #ffe6f0;"> <!-- 🌸 background pink muda -->

<!-- Navbar User -->
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

<!-- Konten Layanan -->
<div class="container mt-5">
    <h3>Hai, <?= $_SESSION['nama'] ?> 👋</h3>
    <p>Silakan pilih layanan yang ingin kamu pesan.</p>

    <div class="row">
        <?php
        $query = mysqli_query($conn, "SELECT * FROM tb_layanan WHERE status='disetujui'");
        while ($l = mysqli_fetch_assoc($query)) {
            $gambar = !empty($l['gambar_layanan']) ? '../uploads/' . $l['gambar_layanan'] : 'https://via.placeholder.com/200x150';
            echo "
            <div class='col-md-4'>
                <div class='card mb-4 shadow card-hover'>
                    <img src='$gambar' class='card-img-top' style='height:200px; object-fit:cover;'>
                    <div class='card-body'>
                        <h5 class='card-title'>{$l['nama_layanan']}</h5>
                        <p class='card-text'>Rp " . number_format($l['harga_layanan'], 0, ',', '.') . "</p>
                        <p class='card-text text-muted'>{$l['deskripsi_layanan']}</p>
                        <form method='POST' action='konfirmasi.php'>
                            <input type='hidden' name='layanan_id' value='{$l['layanan_id']}'>
                            <button type='submit' class='btn btn-success btn-sm'>Pesan</button>
                        </form>
                    </div>
                </div>
            </div>";
        }
        ?>
    </div>
</div> 

<!-- Footer -->
<footer class="mt-5 py-4 text-center text-white" style="background-color: rgb(250, 22, 239);">
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
