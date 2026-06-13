<?php
require 'data/connection.php';
session_start();

// Proteksi: Hanya Admin yang boleh menghapus pesanan
if (!isset($_SESSION['login']) || !$_SESSION['login'] || !isset($_SESSION['role']) || $_SESSION['role'] != 'Admin') {
    header("location:index.php");
    exit();
}

// Validasi ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("location:list_pesanan.php");
    exit();
}

$id = (int)$_GET['id'];

// Hapus detail dulu (foreign key lebih aman)
mysqli_query($connection, "DELETE FROM detail_pesanan WHERE id_pesanan = $id");

// Hapus pesanan induk
mysqli_query($connection, "DELETE FROM pesanan WHERE id = $id");

header("location:list_pesanan.php");
exit();
?>
