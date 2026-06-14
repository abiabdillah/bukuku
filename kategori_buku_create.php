<?php include("template/header.php"); ?>
<?php 
    

    if(isset($_POST['submit'])){
        extract($_POST);
        $query = "INSERT INTO `kategori_buku`(`nama`) VALUES ('$nama')";
        mysqli_query($connection,$query);

        header("location:kategori_buku.php");
    }
?>



<div class="container" >
    <h1>Tambah Kategori</h1>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Kategori</label>
            <input type="text" name="nama" class="form-control" id="nama">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>


<div class="clearfix" style="bottom: 0; position: fixed; width: 100%; background-color: var(--background); left:0;">
    <?php include("template/footer.php"); ?>

</div>


