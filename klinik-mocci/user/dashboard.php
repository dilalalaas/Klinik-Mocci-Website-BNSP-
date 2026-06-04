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
    <style>
        .card-hover {
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .card-hover:hover {
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
            transform: scale(1.02);
        }
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .popup-modal {
            animation: slideUp 0.3s ease-in-out;
        }
    </style>
</head>

<body style="background-color: #ffe6f0;">

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
          <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'riwayat.php' ? 'active' : '' ?>" href="riwayat.php">Riwayat</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'status.php' ? 'active' : '' ?>" href="status.php">Status</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                <img src="../uploads/avatar.jpg" class="rounded-circle me-2" width="32" height="32" alt="User">
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalSetting">👤 Setting</a></li>
                <li><a class="dropdown-item" href="logout.php">🔒 Logout</a></li>
            </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Bubble Chat Modal (Konfirmasi Pemesanan) -->
<?php
if (isset($_GET['layanan_id'])) {
    $layanan_id = $_GET['layanan_id'];
    $user_id = $_SESSION['user_id'];

    $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_user WHERE user_id='$user_id'"));
    $layanan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_layanan WHERE layanan_id='$layanan_id'"));
?>
<div class="modal fade show d-block" tabindex="-1" style="background-color: rgba(0,0,0,0.5);">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content popup-modal">
      <div class="modal-header">
        <h5 class="modal-title">Konfirmasi Pemesanan</h5>
      </div>
      <div class="modal-body">
        <p><strong>Nama:</strong> <?= $user['nama'] ?></p>
        <p><strong>Email:</strong> <?= $user['email'] ?></p>
        <p><strong>Layanan:</strong> <?= $layanan['nama_layanan'] ?></p>
        <p><strong>Harga:</strong> Rp <?= number_format($layanan['harga_layanan'], 0, ',', '.') ?></p>
      </div>
      <div class="modal-footer">
        <form method="POST" action="proses_pesan.php">
            <input type="hidden" name="layanan_id" value="<?= $layanan_id ?>">
            <button type="submit" name="konfirmasi" class="btn btn-success">Ya, Lanjutkan</button>
            <a href="dashboard.php" class="btn btn-secondary">Batal</a>
        </form>
      </div>
    </div>
  </div>
</div>
<?php } ?>

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
                        <a href='dashboard.php?layanan_id={$l['layanan_id']}' class='btn btn-success btn-sm'>Pesan</a>
                    </div>
                </div>
            </div>";
        }
        ?>
    </div>
</div>

<!-- Modal Setting Akun -->
<?php
$user_id = $_SESSION['user_id'];
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_user WHERE user_id='$user_id'"));
?>
<div class="modal fade" id="modalSetting" tabindex="-1" aria-labelledby="modalSettingLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalSettingLabel">Akun</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <p><strong>Nama:</strong> <?= $user['nama'] ?></p>
            <p><strong>Email:</strong> <?= $user['email'] ?></p>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Footer -->
<footer class="mt-5 py-4 text-center text-white" style="background-color: rgb(250, 22, 239);">
    <div class="container">
        <p class="mb-1"><strong>Alamat:</strong> Jl. Cantik No. 1, Depok</p>
        <p class="mb-1"><strong>Kontak:</strong> 0813-8726-9994</p>
        <p class="mb-0"><strong>Email:</strong> info@moccibeauty.com</p>
    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
