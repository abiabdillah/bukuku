<?php 
include("template/header.php"); 

// Proteksi halaman keranjang
if (!isset($_SESSION['login']) || !$_SESSION['login']) {
    header("location:index.php");
    exit();
}

// AMANKAN DI SINI: Kalau $_SESSION['id'] belum ke-set, isi pake 0 biar query ga jebol
$id_user = isset($_SESSION['id']) ? $_SESSION['id'] : 0;
?>

<style>
    :root{--blue-600:#0a66ff;--blue-700:#0d4ea6;--ink:#0b1220;}
    .cart-hero{
        background: linear-gradient(135deg, rgba(10,102,255,.14), rgba(13,78,166,.06));
        border: 1px solid rgba(10,102,255,.18);
        border-radius: 1rem;
        padding: 1.25rem;
        box-shadow: 0 10px 30px rgba(10,102,255,.08);
    }
    .cart-table{
        border-radius: 1rem;
        overflow: hidden;
        border: 1px solid rgba(13,78,166,.10);
    }
    .cart-thumb{width:64px;height:auto; border-radius:.6rem;}
    .cart-row-card{
        background: rgba(255,255,255,.75);
    }
    .cart-total-pill{
        display:flex; align-items:center; justify-content:flex-end; gap:.75rem;
        padding: .9rem 1rem; border-radius: .9rem;
        background: linear-gradient(135deg, rgba(10,102,255,.12), rgba(143,211,255,.08));
        border: 1px solid rgba(10,102,255,.20);
    }
    .cart-actions .btn{border-radius:.9rem;}
</style>

<div class="container">
    <div class="cart-hero mb-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h1 class="mb-1" style="color:var(--ink);">Keranjang Belanja Anda</h1>
                <div class="text-muted">Review item sebelum checkout.</div>
            </div>
        </div>
    </div>

<div class="table-responsive"><table class="table align-middle cart-table">
        <thead class="table-light">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Gambar</th>
                <th scope="col">Judul Buku</th>
                <th scope="col">Harga</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Subtotal</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $x = 1;
                $total_belanja = 0;

                // Query join tabel cart dengan tabel buku berdasarkan user yang login
                $query = "SELECT cart.*, buku.judul_buku, buku.harga, buku.gambar 
                          FROM cart 
                          JOIN buku ON cart.id_buku = buku.id 
                          WHERE cart.id_user = $id_user";
                          
                $data = mysqli_query($connection, $query);

                if (mysqli_num_rows($data) > 0) {
                    while($data_row = mysqli_fetch_assoc($data)){
                        $subtotal = $data_row['harga'] * $data_row['jumlah'];
                        $total_belanja += $subtotal;
                        ?>
                            <tr>
                                <th scope="row"><?=$x?></th>
                                <td>
                                    <img src="img/<?=$data_row['gambar']?>" alt="Cover" style="width: 60px; height: auto;" class="img-thumbnail">
                                </td>
                                <td><strong><?=$data_row['judul_buku']?></strong></td>
                                <td>Rp <?=number_format($data_row['harga'], 0, ',', '.')?></td>
                                <td><?=$data_row['jumlah']?></td>
                                <td>Rp <?=number_format($subtotal, 0, ',', '.')?></td>
                                <td>
                                    <div class="d-flex gap-2 flex-wrap">
                                        <a href="cart_aksi.php?action=add&id_buku=<?=$data_row['id_buku']?>" class="btn btn-sm btn-primary">Tambah</a>
                                        <a href="cart_aksi.php?action=delete&id_buku=<?=$data_row['id_buku']?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus buku ini dari keranjang?')">Hapus</a>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        $x++;
                    }
                    ?>
                        <tr class="table-light fw-bold">
                            <td colspan="5" class="text-end">Total Yang Harus Dibayar :</td>
                            <td colspan="2">Rp <?=number_format($total_belanja, 0, ',', '.')?></td>
                        </tr>
                    <?php
                } else {
                    ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">Keranjang belanja masih kosong</td>
                        </tr>
                    <?php
                }
            ?>
        </tbody>
</table>
</div>

    <div class="d-flex justify-content-between align-items-center mt-4 flex-wrap gap-3">
        <a href="listbuku.php" class="btn btn-outline-primary">Kembali Belanja</a>
        <?php if (mysqli_num_rows($data) > 0) : ?>
            <a href="checkout_aksi.php" class="btn btn-success fw-semibold">Checkout (Buat Pesanan)</a>
        <?php endif; ?>
    </div>
</div>
</div>
<div class="footer" style = "width: 100%; background-color: var(--background); padding: 1rem 0; text-align: center; margin-top: auto;">
    <?php include("template/footer.php"); ?>
</div>
