<?php
include '../config/koneksi.php';

if (isset($_POST['daftar'])) {
    $nama     = $_POST['nama'];
    $email    = $_POST['email'];
    $password = $_POST['password'];

    // Cek apakah email sudah terdaftar
    $cek = mysqli_query($conn, "SELECT * FROM tb_user WHERE email='$email'");
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('Email sudah terdaftar');</script>";
    } else {
        $insert = mysqli_query($conn, "INSERT INTO tb_user (nama, email, password) VALUES ('$nama', '$email', '$password')");
        if ($insert) {
            echo "<script>alert('Pendaftaran berhasil, silakan login'); window.location='../login.php';</script>";
        } else {
            echo "<script>alert('Pendaftaran gagal');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Akun User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body style="background-color: #ffe6f0;"> <!-- 🌸 pink muda -->

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4 bg-white p-4 rounded shadow">
            <h4 class="text-center mb-4">Daftar Akun</h4>
            <form method="POST">
                <div class="mb-3">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" name="daftar" class="btn btn-success w-100">Daftar</button>
                <p class="text-center mt-3">Sudah punya akun? <a href="login.php">Login</a></p>
            </form>
        </div>
    </div>
</div>

</body>
</html>
