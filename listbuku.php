<?php include("template/header.php"); ?>

<style>
    :root {
        --blue-600: #0a66ff;
        --blue-700: #0d4ea6;
        --text-dark: #0b1220;
    }

    .page-hero {
        background: linear-gradient(135deg, rgba(10,102,255,.14), rgba(13,78,166,.06));
        border: 1px solid rgba(10,102,255,.18);
        border-radius: 1rem;
        padding: 1.25rem 1.25rem;
        box-shadow: 0 10px 30px rgba(10, 102, 255, .08);
    }

    .book-card {
        border-radius: 1rem;
        border: 1px solid rgba(13, 78, 166, .10);
        overflow: hidden;
        transition: transform .15s ease, box-shadow .15s ease, border-color .15s ease;
    }

    .book-card:hover {
        transform: translateY(-4px);
        border-color: rgba(10, 102, 255, .35);
        box-shadow: 0 18px 45px rgba(10, 102, 255, .18);
    }

    .book-cover {
        height: 240px;
        object-fit: cover;
        background: #f3f6ff;
    }

    .price-pill {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 999px;
        padding: .45rem .85rem;
        background: linear-gradient(135deg, rgba(10,102,255,.18), rgba(143,211,255,.10));
        border: 1px solid rgba(10,102,255,.25);
        color: var(--blue-700);
        font-weight: 800;
    }

    .book-actions .btn {
        border-radius: .9rem;
    }

    /* Search UI wrapper (mobile-friendly) */
    .search-bar-wrapper {
        border-radius: 1rem;
        border: 1px solid rgba(10, 102, 255, .16);
        background: rgba(255, 255, 255, .65);
        padding: .75rem;
    }

    .search-form {
        width: 100%;
    }

    .search-row {
        display: flex;
        gap: .5rem;
    }

    .search-input {
        flex: 1;
        border-radius: .9rem !important;
        border: 1px solid rgba(10, 102, 255, .18) !important;
        background: rgba(255, 255, 255, .8) !important;
    }

    .search-btn {
        white-space: nowrap;
        border-radius: .9rem !important;
        padding-left: 1rem;
        padding-right: 1rem;
    }

    @media (max-width: 576px) {
        .search-bar-wrapper {
            padding: .65rem;
        }

        .search-row {
            flex-direction: row;
            align-items: center;
        }

        .search-btn {
            padding-left: .9rem;
            padding-right: .9rem;
            min-height: calc(2.5rem);
        }

        .search-input {
            min-height: calc(2.5rem);
        }
    }
</style>

<div class="container mt-4" style="min-height: calc(100vh - 70px); d-flex; flex-direction: column;">
    <div class="page-hero mb-4" style="flex: 1;">

        <?php
            // Data statistik: jumlah buku & jumlah kategori
            $total_buku = 0;
            $total_kategori = 0;

            $q_buku = mysqli_query($connection, "SELECT COUNT(*) AS total FROM buku");
            if ($q_buku && mysqli_num_rows($q_buku) > 0) {
                $r_buku = mysqli_fetch_assoc($q_buku);
                $total_buku = (int)($r_buku['total'] ?? 0);
            }

            $q_kat = mysqli_query($connection, "SELECT COUNT(*) AS total FROM kategori_buku");
            if ($q_kat && mysqli_num_rows($q_kat) > 0) {
                $r_kat = mysqli_fetch_assoc($q_kat);
                $total_kategori = (int)($r_kat['total'] ?? 0);
            }
        ?>

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h1 class="mb-1" style="color: var(--text-dark);">List Buku</h1>
                <h5 class="text-muted mb-0">Selamat datang, <?= $_SESSION['nama'] ?>! <span class="badge bg-secondary"><?= $_SESSION['role'] ?></span></h5>

                <div class="d-flex flex-wrap gap-2 mt-3">
                    <div class="price-pill">
                        <span class="me-2">📚</span>
                        <span><?= $total_buku ?></span>
                        <span class="ms-1" style="font-weight:700;">Buku</span>
                    </div>
                    <div class="price-pill" style="background: linear-gradient(135deg, rgba(13,78,166,.18), rgba(143,211,255,.10));">
                        <span class="me-2">🏷️</span>
                        <span><?= $total_kategori ?></span>
                        <span class="ms-1" style="font-weight:700;">Kategori</span>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2">
                <?php if ($_SESSION['role'] == 'Admin') : ?>
                    <a href="buku_create.php" class="btn btn-primary fw-semibold">
                        <i class="bi bi-plus-circle"></i> Tambah Buku Baru
                    </a>
                <?php else : ?>
                    <a href="cart.php" class="btn btn-outline-primary fw-semibold">
                        Lihat Keranjang
                    </a>
                <?php endif; ?>

            </div>
    
    <!-- UI search -->
    <div class="search-bar-wrapper mb-3">
        <form class="search-form" role="search" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="search-row">
                <input class="form-control search-input" name="search" type="search" placeholder="Search" aria-label="Search" />
                <button name="submit" class="btn btn-primary search-btn" type="submit">
                    Cari
                </button>
            </div>
        </form>
    </div>
<!-- UI search end -->
    <div class="row g-4"> 
        <?php
        // logic search
        if (!isset($_POST['search']) || empty($_POST['search'])) {
            // Query ambil data buku digabung dengan nama kategorinya
            $query = "SELECT buku.*, kategori_buku.nama AS nama_kategori 
                  FROM buku 
                  LEFT JOIN kategori_buku ON buku.id_kategori_buku = kategori_buku.id 
                  ORDER BY buku.id DESC";
        } else {
            // Query ambil data buku digabung dengan nama kategorinya
            $query = "SELECT buku.*, kategori_buku.nama AS nama_kategori 
                  FROM buku 
                  LEFT JOIN kategori_buku ON buku.id_kategori_buku = kategori_buku.id 
                  WHERE buku.judul_buku LIKE '%" . $_POST['search'] . "%' ORDER BY buku.id DESC";
        }
            // logic search end
        $data = mysqli_query($connection, $query);

        if (mysqli_num_rows($data) > 0) {
            while ($data_row = mysqli_fetch_assoc($data)) {
        ?>
                <div class="col-md-4 col-lg-3">
                    <div class="card h-100 book-card shadow-sm border-0">
                        <img src="img/<?= $data_row['gambar'] ?>" class="card-img-top book-cover" alt="Cover Buku">

                        <div class="card-body d-flex flex-column">
                            <span class="badge bg-info text-white mb-2 align-self-start"><?= $data_row['nama_kategori'] ?? 'Tanpa Kategori' ?></span>
                            <h5 class="card-title fw-bold text-dark text-truncate" title="<?= $data_row['judul_buku'] ?>"><?= $data_row['judul_buku'] ?></h5>
                            <p class="card-text text-muted small mb-1">Pengarang: <?= $data_row['pengarang'] ?></p>
                            <p class="card-text text-muted small mb-3">Penerbit: <?= $data_row['penerbit'] ?> (<?= $data_row['tahun_terbit'] ?>)</p>

                            <div class="mt-auto">
                                <h6 class="fw-bold text-primary fs-5 mb-3">Rp <?= number_format($data_row['harga'], 0, ',', '.') ?></h6>

                                <?php if ($_SESSION['role'] == 'Admin') : ?>
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-between">
                                        <a href="buku_update.php?id=<?= $data_row['id'] ?>" class="btn btn-sm btn-warning text-white flex-grow-1">Ubah</a>
                                        <a href="buku_delete.php?id=<?= $data_row['id'] ?>" class="btn btn-sm btn-danger flex-grow-1" onclick="return confirm('Yakin ingin menghapus buku ini?')">Hapus</a>
                                    </div>
                                <?php else : ?>
                                    <div class="d-grid">
                                        <a href="cart_aksi.php?action=add&id_buku=<?= $data_row['id'] ?>" class="btn btn-success fw-semibold">
                                            Tambah ke Keranjang
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
        } else {
            ?>
            <div class="col-12">
                <div class="alert alert-light text-center py-5 border" role="alert">
                    <h4 class="text-muted">Belum ada koleksi buku nih.</h4>
                    <?php if ($_SESSION['role'] == 'Admin') : ?>
                        <p class="text-muted small">Silahkan klik tombol Tambah Buku di atas untuk mengisinya.</p>
                    <?php endif; ?>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>
<div class="clearfix"></div>

<br>


<?php include("template/footer.php"); ?>