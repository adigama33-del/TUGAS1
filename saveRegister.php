<?php
require_once 'inc/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm  = $_POST['confirm'] ?? '';
    $fullname = $_POST['fullname'] ?? '';
    $city     = $_POST['city'] ?? '';

    // Validasi Password
    if ($password !== $confirm) {
        Utility::redirect('register.php', 'Password tidak cocok.');
    }

    // Proses Simpan
    $user = new User();
    $user->username = $username;
    $user->setPassword($password);
    $user->fullname = $fullname;
    $user->city = $city;

    if ($user->save()) {
        Utility::redirect('login.php', 'Akun berhasil dibuat. Silakan login.');
    } else {
        Utility::redirect('register.php', 'Pendaftaran gagal.');
    }
}
Utility::redirect('register.php');