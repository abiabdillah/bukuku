<?php
require 'data/connection.php';

$error = $_GET['error'] ?? '';
$success = $_GET['success'] ?? '';
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookstore</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <style>
        :root {
            --blue-900: #0b2a5b;
            --blue-700: #0d4ea6;
            --blue-600: #0a66ff;
            --blue-500: #1a8cff;
            --blue-200: #8fd3ff;
        }

        body {
            min-height: 100vh;
            background: radial-gradient(1200px 600px at 20% 10%, rgba(143, 211, 255, .35) 0%, rgba(143, 211, 255, 0) 55%),
                        linear-gradient(135deg, var(--blue-900) 0%, var(--blue-700) 35%, #0b2b6a 100%);
        }

        .login-wrap {
            min-height: 75vh;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.18);
            border-radius: 1rem;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25);
            position: relative;
            overflow: hidden;
        }

        .login-card:before {
            content: "";
            position: absolute;
            inset: -2px;
            background: linear-gradient(135deg, rgba(26, 140, 255, .9), rgba(143, 211, 255, .2), rgba(26, 140, 255, .0));
            opacity: 0.35;
            pointer-events: none;
        }

        .login-card .card-body {
            position: relative;
            z-index: 1;
        }

        .login-title {
            color: #eaf5ff;
            letter-spacing: .2px;
        }

        label.form-label {
            color: rgba(255, 255, 255, 0.9);
        }

        .form-control {
            background: rgba(255, 255, 255, 0.10);
            border: 1px solid rgba(255, 255, 255, 0.22);
            color: #fff;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .form-control:focus {
            border-color: rgba(143, 211, 255, 0.8);
            box-shadow: 0 0 0 .25rem rgba(26, 140, 255, .25);
            color: #fff;
            background: rgba(255, 255, 255, 0.12);
        }

        .form-check-input {
            background-color: rgba(255, 255, 255, 0.10);
            border-color: rgba(255, 255, 255, 0.35);
        }

        .form-check-input:focus {
            box-shadow: 0 0 0 .25rem rgba(26, 140, 255, .25);
            border-color: rgba(143, 211, 255, 0.8);
        }

        .form-check-label {
            color: rgba(255, 255, 255, 0.75);
        }

        .btn-gradient {
            border: 0;
            color: #fff;
            font-weight: 600;
            padding: 0.75rem 1rem;
            border-radius: 0.75rem;
            background: linear-gradient(135deg, var(--blue-600), var(--blue-500));
            box-shadow: 0 12px 30px rgba(10, 102, 255, 0.35);
            transition: transform .15s ease, box-shadow .15s ease, filter .15s ease;
        }

        .btn-gradient:hover {
            filter: brightness(1.05);
            transform: translateY(-1px);
            box-shadow: 0 16px 40px rgba(10, 102, 255, 0.45);
            color: #fff;
        }

        .btn-register {
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
            font-weight: 600;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.18);
            color: rgba(255, 255, 255, 0.95);
            transition: background .15s ease, transform .15s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
        }

        .btn-register:hover {
            background: rgba(255, 255, 255, 0.18);
            transform: translateY(-1px);
            color: #fff;
            text-decoration: none;
        }

        .alert-danger {
            background: rgba(220, 53, 69, 0.18);
            border-color: rgba(220, 53, 69, 0.30);
            color: #ffd7dd;
            border-radius: 0.75rem;
        }

        @media (max-width: 576px) {
            .login-wrap {
                min-height: 65vh;
            }

            .login-card {
                border-radius: 0.9rem;
            }
        }
    </style>
</head>

<body>

    <main class="d-flex align-items-center justify-content-center login-wrap">
        <div class="card login-card p-4 shadow" style="width: 100%; max-width: 420px;">
            <div class="card-body">
                <h3 class="card-title text-center mb-4 fw-bold login-title">Daftar</h3>

                <?php if (!empty($success)) { ?>
                    <div class="alert alert-success text-center shadow-sm" role="alert">
                        <?= htmlspecialchars($success) ?>
                    </div>
                <?php } elseif (!empty($error)) { ?>
                    <div class="alert alert-danger text-center shadow-sm" role="alert">
                        <?= htmlspecialchars($error) ?>
                    </div>
                <?php } ?>

                <form action="register_aksi.php" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label fw-semibold">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" required>
                    </div>

                    <div class="mb-3">
                        <label for="confirm_password" class="form-label fw-semibold">Confirm Password</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Konfirmasi Password" required>
                    </div>

                    <div class="mb-3">
                        <label for="nama" class="form-label fw-semibold">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama" required>
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label fw-semibold">Alamat</label>
                        <textarea class="form-control" name="alamat" id="alamat" required placeholder="Masukan Alamat"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email" required>
                    </div>

                    <div class="mb-3">
                        <label for="no_telp" class="form-label fw-semibold">No Telepon</label>
                        <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="Masukkan No Telepon" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Jenis Kelamin</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin_l" value="L" required>
                            <label class="form-check-label" for="jenis_kelamin_l">Laki-Laki</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin_p" value="P" required>
                            <label class="form-check-label" for="jenis_kelamin_p">Perempuan</label>
                        </div>
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" name="submit" class="btn btn-gradient fw-semibold">Submit</button>
                    </div>

                    <div class="d-grid gap-2 mt-3">
                        <a href="index.php" class="btn-register fw-semibold">
                            <span aria-hidden="true">←</span>
                            Kembali ke Login
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </main>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>
