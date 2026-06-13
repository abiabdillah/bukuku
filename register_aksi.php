<?php
    require 'data/connection.php';

    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $nama = $_POST['nama'] ?? '';
    $alamat = $_POST['alamat'] ?? '';
    $email = $_POST['email'] ?? '';
    $no_telp = $_POST['no_telp'] ?? '';
    $jenis_kelamin = $_POST['jenis_kelamin'] ?? '';

    // Cek username sudah ada atau belum
    $query = "SELECT id FROM user WHERE username = '$username'";
    $data = mysqli_query($connection, $query);

    if (mysqli_num_rows($data) >= 1) {
        $error = "Username Sudah Terdaftar";
        header("location:register.php?error=" . urlencode($error));
        exit;
    }

    if ($confirm_password !== $password) {
        $error = "data password dan konfirmasi password berbeda";
        header("location:register.php?error=" . urlencode($error));
        exit;
    }

    // menginput data ke database
    mysqli_query(
        $connection,
        "INSERT INTO user VALUES('', '$username', '$password', '$nama', 'User', '$alamat', '$email', '$no_telp', '$jenis_kelamin')"
    );

    // Notifikasi sukses registrasi
    header("location:index.php?success=" . urlencode('Registrasi berhasil. Silakan login.'));
    exit;
?>
