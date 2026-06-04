<?php
session_start();
include '../config/koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (!empty($password)) {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $update = mysqli_query($conn, "UPDATE tb_user SET password='$hashed' WHERE user_id='$user_id'");

        if ($update) {
            echo "<script>alert('Password berhasil diubah'); window.location='dashboard.php';</script>";
        } else {
            echo "<script>alert('Gagal mengubah password'); window.location='dashboard.php';</script>";
        }
    } else {
        echo "<script>alert('Password tidak boleh kosong'); window.location='dashboard.php';</script>";
    }
}
?>
