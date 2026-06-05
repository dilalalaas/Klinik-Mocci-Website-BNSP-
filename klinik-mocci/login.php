<?php
session_start();
include 'config/koneksi.php';

if (isset($_POST['login'])) {
    $input = $_POST['username'];
    $password = $_POST['password'];

    // Cek sebagai admin
    $admin = mysqli_query($conn, "SELECT * FROM tb_admin WHERE username='$input' AND password='$password'");
    if (mysqli_num_rows($admin) > 0) {
        $_SESSION['admin'] = $input;
        header("Location: admin/dashboard.php");
        exit;
    }

    // Cek sebagai user
    $user = mysqli_query($conn, "SELECT * FROM tb_user WHERE email='$input' AND password='$password'");
    if (mysqli_num_rows($user) > 0) {
        $data = mysqli_fetch_assoc($user);
        $_SESSION['user_id'] = $data['user_id'];
        $_SESSION['nama'] = $data['nama'];
        header("Location: user/dashboard.php");
        exit;
    }

    // Gagal login
    echo "<script>alert('Email/Username atau Password salah');</script>";
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login Klinik Mocci</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body style="background-color: #ffe6f0;">
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-4 bg-white p-4 rounded shadow">
        <h4 class="text-center mb-4">Login Klinik Mocci</h4>
        <form method="POST">
          <div class="mb-3">
            <label>Email / Username</label>
            <input type="text" name="username" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
          </div>
          <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
          <p class="text-center mt-3">Belum punya akun? <a href="user/daftar.php">Daftar</a></p>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
