<?php
include 'template/header.php';
?>

    <div class="row justify-content-center">
        <div class="col-12 col-lg-9">
            <div class="text-center mb-4">
                <h1 class="fw-bold text-primary">Tentang Kami</h1>
                <p class="text-muted mb-0">Toko Buku yang fokus pada kualitas bacaan dan pengalaman belanja.</p>
            </div>

            <div class="card shadow border-0">
                <div class="card-body p-4 p-md-5">
                    <div class="row g-4 align-items-center">

                        <div class="col-12 col-md-7">
                            <h3 class="fw-bold mb-3">Visi</h3>
                            <p class="text-muted mb-4">
                                Menyediakan layanan toko buku online yang mudah digunakan, cepat, dan nyaman.
                            </p>

                            <h3 class="fw-bold mb-3">Misi</h3>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item border-0 px-0 py-2">Memudahkan pencarian dan pemesanan buku.</li>
                                <li class="list-group-item border-0 px-0 py-2">Menyajikan informasi kategori dan detail buku secara jelas.</li>
                                <li class="list-group-item border-0 px-0 py-2">Memberikan pengalaman pengguna yang informatif melalui fitur cart dan checkout.</li>
                            </ul>

                            <div class="mt-4">
                                <a href="listbuku.php" class="btn btn-primary px-4 tentang-btn">Lihat Buku</a>
                                <a href="hubungi_kami.php" class="btn btn-outline-primary ms-2 px-4 tentang-btn">Hubungi Kami</a>
                            </div>
                        </div>

                        <div class="col-12 col-md-5">
                            <h3 class="fw-bold mb-3">Review Pelanggan</h3>

                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="card border-0 shadow-sm" style="background: rgba(13,110,253,.06); border-radius:1rem;">
                                        <div class="card-body p-3">
                                            <div class="d-flex align-items-center justify-content-between gap-3">
                                                <div class="fw-bold">Andi R.</div>
                                                <div class="text-warning" aria-label="rating 5">★★★★★</div>
                                            </div>
                                            <p class="text-muted mb-2" style="font-size:.95rem;">Buku cepat sampai dan covernya sesuai foto. Katalognya juga gampang dicari!</p>
                                            <div class="text-muted small">— Review Terverifikasi</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="card border-0 shadow-sm" style="background: rgba(13,110,253,.06); border-radius:1rem;">
                                        <div class="card-body p-3">
                                            <div class="d-flex align-items-center justify-content-between gap-3">
                                                <div class="fw-bold">Siti N.</div>
                                                <div class="text-warning" aria-label="rating 4">★★★★☆</div>
                                            </div>
                                            <p class="text-muted mb-2" style="font-size:.95rem;">Checkout-nya simple. Detail harga dan jumlahnya jelas, jadi tidak bingung.</p>
                                            <div class="text-muted small">— Dipublikasikan minggu ini</div>
                                        </div>
                                    </div>
                                </div>
                
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>

<?php 
include 'template/footer.php';
?>

