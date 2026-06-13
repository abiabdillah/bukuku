<?php
require 'data/connection.php';

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
        }

        .btn-register:hover {
            background: rgba(255, 255, 255, 0.18);
            transform: translateY(-1px);
            color: #fff;
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

    <main class="d-flex align-items-center justify-content-center login-wrap" >
<div class="card login-card p-4" style="width: 100%; max-width: 420px;">
            <div class="card-body">
                <div class="text-center mb-4">
                    <div class="d-inline-flex align-items-center justify-content-center" style="width:56px;height:56px;border-radius:16px;background:rgba(10,102,255,.18);border:1px solid rgba(143,211,255,.35);box-shadow:0 12px 30px rgba(10,102,255,.15);">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,.95)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                            <circle cx="12" cy="7" r="4"/>
                        </svg>
                    </div>
                    <h3 class="card-title mt-3 mb-2 fw-bold login-title" style="font-size: 1.6rem;">Silahkan Masuk</h3>
                    <p class="text-center text-white-50 mb-0" style="letter-spacing:.2px;">Login untuk mulai berbelanja buku.</p>
                </div>

                <?php if (!empty($success)) { ?>
                    <div class="alert alert-success text-center shadow-sm border-0" role="alert" style="background: rgba(25,135,84,.18); color:#d1ffe6;">
                        <?= htmlspecialchars($success) ?>
                    </div>
                <?php } ?>


                <form action="login_aksi.php" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label fw-semibold">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="rememberMe">
                        <label class="form-check-label small" for="rememberMe">Ingatkan saya di perangkat ini</label>
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" name="submit" class="btn btn-gradient fw-semibold">Login</button>
                    </div>

                    <div class="d-grid gap-2 mt-3">
                        <a href="register.php" class="btn btn-register fw-semibold">Register</a>
                    </div>
                </form>

            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>
