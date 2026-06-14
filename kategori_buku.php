
<?php include("template/header.php"); ?>

<style>
    :root{--blue-600:#0a66ff;--blue-700:#0d4ea6;--ink:#0b1220;--glass:rgba(255,255,255,.08);}
    .page-hero{
        background: linear-gradient(135deg, rgba(10,102,255,.16), rgba(13,78,166,.06));
        border: 1px solid rgba(10,102,255,.20);
        border-radius: 1rem;
        padding: 1.25rem;
        box-shadow: 0 10px 30px rgba(10,102,255,.08);
    }
    .glass-card{
        background: rgba(255,255,255,.06);
        border: 1px solid rgba(255,255,255,.16);
        border-radius: 1rem;
        overflow: hidden;
    }
    .table-modern{margin-bottom:0;}
    .table-modern thead th{
        background: rgba(10,102,255,.12);
        color: var(--ink);
        font-weight: 700;
    }
    .table-modern tbody tr:hover{background: rgba(10,102,255,.06);}
    .btn-modern{border-radius: .9rem; font-weight: 600;}
    .badge-modern{border-radius: .75rem; padding: .45rem .75rem;}

    /* Mobile: ikon aksi biar enak disentuh & ukurannya konsisten */
    @media (max-width: 576px) {
        .table-modern td .btn-modern {
            min-width: 2.6rem;
            padding-left: .65rem;
            padding-right: .65rem;
            line-height: 1;
        }
    }

</style>

<div class="container">
    <div class="page-hero mb-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h1 class="m-0" style="color:var(--ink);">Kategori Buku</h1>
                <div class="text-muted">Kelola kategori buku dengan tampilan yang lebih rapi.</div>
            </div>
            <div>
                <a href="kategori_buku_create.php" class="btn btn-primary btn-modern">
                    Tambah Data
                </a>
            </div>
        </div>
    </div>

    <div class="glass-card">
<div class="table-responsive"><table class="table table-striped table-hover align-middle table-modern">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Kategori</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $x=1;
                $query = "SELECT * FROM kategori_buku";
                $data = mysqli_query($connection, $query);
                while($data_row = mysqli_fetch_assoc($data)){
                    ?>
                        <tr>
                            <th scope="row"><?=$x?></th>
                            <td><?=$data_row['nama']?></td>
                            <td>
                                <div class="d-flex gap-2 align-items-center">
                                    <a href="kategori_buku_update.php?id=<?=$data_row['id']?>" class="btn btn-sm btn-warning btn-modern d-inline-flex align-items-center justify-content-center" aria-label="Ubah kategori">
                                        <i class="bi bi-pencil"></i>
                                        <span class="d-none d-sm-inline ms-1">Ubah</span>
                                    </a>
                                    <a href="kategori_buku_delete.php?id=<?=$data_row['id']?>" class="btn btn-sm btn-danger btn-modern d-inline-flex align-items-center justify-content-center" aria-label="Hapus kategori" onclick="return confirm('Yakin ingin menghapus kategori ini?')">
                                        <i class="bi bi-trash"></i>
                                        <span class="d-none d-sm-inline ms-1">Hapus</span>
                                    </a>
                                </div>
                            </td>

                        </tr>
                    <?php
                    $x++;
                }
            ?>
        </tbody>
    </table>
</div>
</div>
<div class="clearfix" style="bottom: 0; position: fixed; width: 100%; background-color: var(--background); left:0;">
    <?php include("template/footer.php"); ?>

</div>