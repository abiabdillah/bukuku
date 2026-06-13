<?php
include 'template/header.php';
?>

<main class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-9">
            <div class="text-center mb-4">
                <h1 class="fw-bold text-primary">Hubungi Kami</h1>
                <p class="text-muted mb-0">Jika ada pertanyaan, silakan hubungi melalui informasi berikut.</p>
            </div>

            <div class="card shadow border-0">
                <div class="card-body p-4 p-md-5">
                    <div class="row g-4 align-items-center">
                        <div class="col-12 col-md-5">
                            <div class="p-4 rounded-4" style="background: linear-gradient(135deg, rgba(13,110,253,.15), rgba(13,110,253,.05));">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width:64px;height:64px; font-weight:700;">
                                        A
                                    </div>
                                    <div>
                                        <div class="fs-5 fw-bold text-primary">Abi Abdillah</div>
                                    </div>
                                </div>

                                <hr class="my-4" />

                                <div class="small text-muted">
                                    halaman ini menampilkan kontak.
                                </div>

                                <div class="mt-4">
                                    <div class="d-flex align-items-start gap-3 mb-3">
                                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle">Email</span>
                                        <div class="text-muted">abiabdillah@gmail.com</div>
                                    </div>
                                    <div class="d-flex align-items-start gap-3 mb-3">
                                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle">Telepon</span>
                                        <div class="text-muted">0812-3456-7890</div>
                                    </div>
                                    <div class="d-flex align-items-start gap-3">
                                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle">Alamat</span>
                                        <div class="text-muted">Jl. Tarumajaya Bekasi</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-7">
                            <h3 class="fw-bold mb-3">Informasi Layanan</h3>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item border-0 px-0 py-2">Tanyakan ketersediaan buku melalui kontak yang tersedia.</li>
                                <li class="list-group-item border-0 px-0 py-2">Untuk masalah pesanan, sertakan nomor pesanan (jika ada).</li>
                                <li class="list-group-item border-0 px-0 py-2">Respon akan dilakukan pada jam kerja.</li>
                            </ul>

                                <div class="mt-4">
                                <a href="listbuku.php" class="btn btn-primary px-4">Lihat Buku</a>

                                <a href="https://wa.me/628973884597" target="_blank" rel="noopener" class="btn btn-outline-primary ms-2 px-4 d-inline-flex align-items-center gap-2">
                                    <span aria-hidden="true" style="width:1.25rem; display:inline-flex; justify-content:center;">💬</span>
                                    WhatsApp
                                </a>
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

