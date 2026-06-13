<?php 
include("template/header.php"); 

// Proteksi: Hanya Admin yang bisa tambah buku
if ($_SESSION['role'] != 'Admin') {
    header("location:listbuku.php");
    exit();
}
?>

<style>
    :root{
        --blue-900:#0b2a5b;
        --blue-700:#0d4ea6;
        --blue-600:#0a66ff;
        --blue-500:#1a8cff;
        --ink:#0b1220;
    }

    .page-hero{
        background: radial-gradient(900px 420px at 10% 10%, rgba(26,140,255,.14) 0%, rgba(26,140,255,0) 60%),
                    linear-gradient(135deg, rgba(10,102,255,.10), rgba(13,78,166,.04));
        border: 1px solid rgba(10,102,255,.16);
        border-radius: 1rem;
        padding: 1.25rem;
        box-shadow: 0 10px 30px rgba(10,102,255,.06);
    }

    .form-glass{
        background: rgba(255,255,255,.06);
        border: 1px solid rgba(255,255,255,.18);
        border-radius: 1rem;
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        box-shadow: 0 20px 60px rgba(0,0,0,.20);
        overflow: hidden;
    }

    .form-glass:before{
        content: "";
        position: absolute;
        inset: -2px;
        background: linear-gradient(135deg, rgba(26,140,255,.9), rgba(143,211,255,.2), rgba(26,140,255,0));
        opacity: .25;
        pointer-events: none;
    }

    .form-glass-inner{position: relative; z-index: 1; padding: 1.25rem;}

    .form-label{color: rgba(0,0,0,.85); font-weight: 600;}

    .form-control,
    .form-select{
        background: rgba(255,255,255,.10);
        border: 1px solid rgba(255,255,255,.22);
        color: #000;
    }

    .form-control::placeholder{color: rgba(255,255,255,.60);}

    .form-control:focus,
    .form-select:focus{
        border-color: rgba(143,211,255,.85);
        box-shadow: 0 0 0 .25rem rgba(26,140,255,.20);
        background: rgba(255,255,255,.12);
        color: #000;
    }

    .btn-blue{
        border: 0;
        color: #000;
        font-weight: 700;
        padding: .8rem 1.1rem;
        border-radius: .9rem;
        background: linear-gradient(135deg, var(--blue-600), var(--blue-500));
        box-shadow: 0 12px 30px rgba(10,102,255,.30);
        transition: transform .15s ease, box-shadow .15s ease, filter .15s ease;
    }

    .btn-blue:hover{filter: brightness(1.05); transform: translateY(-1px); box-shadow: 0 16px 40px rgba(10,102,255,.45);}

    .btn-outline-blue{
        border-radius: .9rem;
        padding: .8rem 1.1rem;
        font-weight: 700;
        background: rgba(255,255,255,.08);
        border: 1px solid rgba(255,255,255,.20);
        color: rgba(255,255,255,.95);
        transition: background .15s ease, transform .15s ease;
    }
    .btn-outline-blue:hover{background: rgba(255,255,255,.14); transform: translateY(-1px); color:#fff;}

    .file-hint{color: rgba(255,255,255,.72); font-size: .9rem;}

    @media (max-width: 576px){
        .btn-outline-blue, .btn-blue{width:100%;}
    }
</style>

<div class="container mt-4">
    <div class="page-hero mb-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h1 class="m-0" style="color:var(--ink);">Tambah Buku Baru</h1>
                <div class="text-muted">Lengkapi data buku dan unggah cover.</div>
            </div>
        </div>
    </div>

    <div class="form-glass position-relative">
        <div class="form-glass-inner">
            <form action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">

        <div class="mb-3">
            <label for="judul_buku" class="form-label">Judul Buku</label>
            <input type="text" name="judul_buku" class="form-control" id="judul_buku" required>
        </div>
        
        <div class="mb-3">
            <label for="id_kategori_buku" class="form-label">Kategori Buku</label>
            <select name="id_kategori_buku" class="form-select" id="id_kategori_buku" required>

                <option value="">-- Pilih Kategori --</option>
                <?php
                $kat_query = mysqli_query($connection, "SELECT * FROM kategori_buku");
                while($kat = mysqli_fetch_assoc($kat_query)) {
                    echo "<option value='".$kat['id']."'>".$kat['nama']."</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="pengarang" class="form-label">Pengarang</label>
            <input type="text" name="pengarang" class="form-control" id="pengarang" required>
        </div>

        <div class="mb-3">
            <label for="penerbit" class="form-label">Penerbit</label>
            <input type="text" name="penerbit" class="form-control" id="penerbit" required>
        </div>

        <div class="mb-3">
            <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
            <input type="text" name="tahun_terbit" class="form-control" id="tahun_terbit" maxlength="4" required>
        </div>

        <div class="mb-3">
            <label for="harga" class="form-label">Harga (Rp)</label>
            <input type="number" name="harga" class="form-control" id="harga" required>
        </div>

        <div class="mb-3">
            <label for="gambar" class="form-label">Cover Buku</label>
            <input type="file" name="gambar" class="form-control" id="gambar" required>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Simpan Buku</button>
        <a href="listbuku.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<?php 
include("template/footer.php");

if(isset($_POST['submit'])){
    extract($_POST);
    
    // Logika upload gambar sederhana ala prosedural
    $nama_gambar = $_FILES['gambar']['name'];
    $tmp_gambar = $_FILES['gambar']['tmp_name'];
    
    // Pindahkan file gambar ke dalam folder 'img'
    move_uploaded_file($tmp_gambar, "img/".$nama_gambar);

    $query = "INSERT INTO `buku`(`id_kategori_buku`, `judul_buku`, `pengarang`, `penerbit`, `tahun_terbit`, `harga`, `gambar`) 
              VALUES ('$id_kategori_buku', '$judul_buku', '$pengarang', '$penerbit', '$tahun_terbit', '$harga', '$nama_gambar')";
    
    mysqli_query($connection, $query);
    header("location:listbuku.php");
}
?>