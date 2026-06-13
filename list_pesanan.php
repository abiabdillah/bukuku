<?php
require 'template/header.php';
?>

<style>
    :root{--blue-600:#0a66ff;--blue-700:#0d4ea6;--ink:#0b1220;}
    .orders-hero{
        background: linear-gradient(135deg, rgba(10,102,255,.14), rgba(13,78,166,.06));
        border: 1px solid rgba(10,102,255,.18);
        border-radius: 1rem;
        padding: 1.25rem;
        box-shadow: 0 10px 30px rgba(10,102,255,.08);
    }
    .orders-table{
        border-radius: 1rem;
        overflow: hidden;
        border: 1px solid rgba(13,78,166,.10);
    }
    .orders-badge{border-radius: .75rem; padding: .45rem .75rem;}
    .orders-actions .btn{border-radius: .9rem;}

    /* Tombol aksi: rapikan ukuran & spasi di mobile/desktop */
    .orders-actions .btn{min-height: 2.25rem;}
    @media (max-width: 576px){
        .orders-actions .btn{min-width: 2.25rem; padding-left:.7rem; padding-right:.7rem;}
    }

</style>

<div class="container mt-4">
    <div class="orders-hero mb-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <h1 class="m-0" style="color:var(--ink);">List Pesanan</h1>
        
        <?php if ($_SESSION['role'] == 'User') : ?>
            <a href="cart.php" class="btn btn-primary fw-semibold">
                <i class="bi bi-plus-circle"></i> Tambah Pesanan Baru
            </a>
        <?php endif; ?>
    </div>
    
<div class="table-responsive"><table class="table table-hover align-middle orders-table table-striped-columns">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">ID Pesanan</th>
                <th scope="col">Nama Pembeli</th>
                <th scope="col">Tanggal Pesanan</th>
                <th scope="col">Total Item</th>
                <th scope="col">Total Bayar</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $x = 1;
                $id_user = isset($_SESSION['id']) ? $_SESSION['id'] : 0;
                
                // Filter query berdasarkan role
                if ($_SESSION['role'] == 'User') {
                    $query = "SELECT pesanan.*, user.nama AS nama_pembeli, user.alamat AS alamat, 
                                     SUM(detail_pesanan.jumlah) AS total_item,
                                     SUM(detail_pesanan.jumlah * detail_pesanan.harga_satuan) AS total_bayar
                              FROM pesanan 
                              JOIN user ON pesanan.id_user = user.id 
                              LEFT JOIN detail_pesanan ON pesanan.id = detail_pesanan.id_pesanan
                              WHERE pesanan.id_user = $id_user
                              GROUP BY pesanan.id
                              ORDER BY pesanan.tanggal DESC";
                } else {
                    $query = "SELECT pesanan.*, user.nama AS nama_pembeli, user.alamat AS alamat, 
                                     SUM(detail_pesanan.jumlah) AS total_item,
                                     SUM(detail_pesanan.jumlah * detail_pesanan.harga_satuan) AS total_bayar
                              FROM pesanan 
                              JOIN user ON pesanan.id_user = user.id 
                              LEFT JOIN detail_pesanan ON pesanan.id = detail_pesanan.id_pesanan
                              GROUP BY pesanan.id
                              ORDER BY pesanan.tanggal DESC";
                }
                          
                $data = mysqli_query($connection, $query);
                
                if (mysqli_num_rows($data) > 0) {
                    while($data_row = mysqli_fetch_assoc($data)){
                        $id_pesanan = $data_row['id'];
                        $status = $data_row['status'];
                        $badge_color = 'bg-warning text-dark'; 
                        
                        if ($status == 'Pengiriman') {
                            $badge_color = 'bg-info text-white';
                        } elseif ($status == 'Selesai') {
                            $badge_color = 'bg-success text-white';
                        }
                        ?>
                            <tr>
                                <th scope="row"><?=$x?></th>
                                <td><strong>#PSN-<?=$id_pesanan?></strong></td>
                                <td><?=$data_row['nama_pembeli']?></td>
                                <td><?=date('d M Y H:i', strtotime($data_row['tanggal']))?></td>
                                <td><?=$data_row['total_item'] ?? 0?> Buku</td>
                                <td>Rp <?=number_format($data_row['total_bayar'] ?? 0, 0, ',', '.')?></td>
                                <td>
                                    <span class="badge <?=$badge_color?>"><?=$status?></span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#detail-<?=$id_pesanan?>">
                                        Detail
                                    </button>

                                    <?php if ($_SESSION['role'] == 'Admin') : ?>
                                        <a href="pesanan_update.php?id=<?=$id_pesanan?>" class="btn btn-sm btn-warning text-white">Edit</a>
                                    <?php endif; ?>

                                    <a href="pesanan_delete.php?id=<?=$id_pesanan?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus data pesanan ini?')">Hapus</a>
                                </td>
                            </tr>

                            <tr class="collapse bg-light" id="detail-<?=$id_pesanan?>">
                                <td colspan="8" class="p-3">
                                    <div class="card card-body border-0 shadow-sm">
                                        <h6 class="fw-bold text-secondary mb-2">Rincian Item Buku (#PESANAN-<?=$id_pesanan?>):</h6>
                                        <div class="mb-3">
                                            <div class="small text-muted">Alamat Pengiriman</div>
                                        <div class="fw-semibold">
                                                <?= htmlspecialchars($data_row['alamat'] ?? '-') ?>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-sm table-bordered m-0 bg-white">
                                                <thead class="table-dark small">
                                                    <tr>
                                                        <th>Judul Buku</th>
                                                        <th>Harga Satuan</th>
                                                        <th class="text-center">Jumlah</th>
                                                        <th>Subtotal</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="small">
                                                    <?php
                                                    // Query ambil item buku di dalam pesanan ini
                                                    $detail_query = mysqli_query($connection, "SELECT detail_pesanan.*, buku.judul_buku 
                                                                                               FROM detail_pesanan 
                                                                                               JOIN buku ON detail_pesanan.id_buku = buku.id 
                                                                                               WHERE detail_pesanan.id_pesanan = $id_pesanan");
                                                    
                                                    while ($detail_row = mysqli_fetch_assoc($detail_query)) {
                                                        $subtotal_item = $detail_row['harga_satuan'] * $detail_row['jumlah'];
                                                        ?>
                                                        <tr>
                                                            <td><?=$detail_row['judul_buku']?></td>
                                                            <td>Rp <?=number_format($detail_row['harga_satuan'], 0, ',', '.')?></td>
                                                            <td class="text-center"><?=$detail_row['jumlah']?></td>
                                                            <td class="fw-semibold text-primary">Rp <?=number_format($subtotal_item, 0, ',', '.')?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        $x++;
                    }
                } else {
                    ?>
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">Belum ada pesanan yang masuk.</td>
                        </tr>
                    <?php
                }
            ?>
        </tbody>
    </table></div>
</div>

<?php
require 'template/footer.php';
?>
