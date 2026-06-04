<?php
session_start();
include '../config/koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$pesan = "";

// Ambil data user
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_user WHERE user_id = '$user_id'"));

// Proses form jika disubmit
if (isset($_POST['simpan'])) {
    $password_lama = mysqli_real_escape_string($conn, $_POST['password_lama']);
    $password_baru = mysqli_real_escape_string($conn, $_POST['password_baru']);
    $konfirmasi = mysqli_real_escape_string($conn, $_POST['konfirmasi']);

    // Validasi password lama
    if ($password_lama !== $data['password']) {
        $pesan = "<div class='alert alert-danger'>Password lama salah!</div>";
    } elseif ($password_baru !== $konfirmasi) {
        $pesan = "<div class='alert alert-danger'>Konfirmasi password tidak cocok!</div>";
    } else {
        // Update password
        $update = mysqli_query($conn, "UPDATE tb_user SET password='$password_baru' WHERE user_id='$user_id'");
        if ($update) {
            $pesan = "<div class='alert alert-success'>Password berhasil diperbarui.</div>";
        } else {
            $pesan = "<div class='alert alert-danger'>Gagal memperbarui password.</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pengaturan Akun</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #ffe6f0;">
<div class="container mt-5">
    <div class="modal-dialog">
        <div class="modal-content shadow">
            <div class="modal-header">
                <h5 class="modal-title">Pengaturan Akun</h5>
                <a href="dashboard.php" class="btn-close"></a>
            </div>
            <div class="modal-body">
                <?= $pesan ?>
                <p><strong>Nama:</strong> <?= $data['nama'] ?></p>
                <p><strong>Email:</strong> <?= $data['email'] ?></p>
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Password Lama</label>
                        <input type="password" name="password_lama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password Baru</label>
                        <input type="password" name="password_baru" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Konfirmasi Password Baru</label>
                        <input type="password" name="konfirmasi" class="form-control" required>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" name="simpan" class="btn btn-primary me-2">Simpan</button>
                        <a href="dashboard.php" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
