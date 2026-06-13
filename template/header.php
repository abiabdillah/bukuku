<?php

ob_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['login']) || !$_SESSION['login']) {
    header("location:index.php");
    exit();
}

require 'data/connection.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://fontawesome.com" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl78fD6LkHq+q9QZx5T4uM1uK2Z9IYEkYv0hA13V4+2L5Yg7A2v6D+0V6E8IYQ9T9e0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Bukuku</title>

    <!-- Favicon dari gambar sendiri -->
    <link rel="icon" href="img/mk.png" type="image/jpeg" sizes="64x64" />

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
    <div class="container-fluid">

        <a class="navbar-brand" href="#">Bukuku</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php if ($_SESSION['role'] == "User") : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="listbuku.php">List Buku</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="list_pesanan.php">List Pesanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tentang_kami.php">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="hubungi_kami.php">Hubungi Kami</a>
                    </li>
                <?php elseif ($_SESSION['role'] == "Admin") : ?>
                    <li class="nav-item">
                        <a class="nav-link active" href="listbuku.php">List Buku</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="kategori_buku.php">Kategori Buku</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="list_user.php">List User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="list_pesanan.php">List Pesanan</a>
                    </li>
                <?php endif; ?>
            </ul>

            <ul class="navbar-nav d-flex">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?= $_SESSION['nama']; ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
    /* Pastikan konten tidak ketutup navbar fixed */
    body { padding-top: 70px; }

    /* Efek saat navigasi diklik/di-focus */
    .navbar .nav-link { transition: background-color .15s ease, color .15s ease; }
    .navbar .nav-link:active,
    .navbar .nav-link:focus,
    .navbar .nav-link.active {
        background-color: rgba(255,255,255,.18) !important;
    .navbar .nav-link.active {
        background-color: rgba(255,255,255,.18) !important;
        color: #fff !important;
        border-radius: .375rem;
    }

    /* Dropdown item aktif */
    .dropdown-item:active { background-color: rgba(255,255,255,.18) !important; }
</style>

<!-- Bootstrap 5 JS bundle (must be loaded once, after page markup) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<div class="container mt-4" style="margin-top: 2px;">
    <div class="row align-items-start">
<div class="d-flex align-items-center justify-content-between mb-3" style="gap: 1rem;">



