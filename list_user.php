<?php include("template/header.php"); ?>

<style>
    :root{--blue-600:#0a66ff;--blue-700:#0d4ea6;--ink:#0b1220;}

    /* Paksa footer turun dan tidak overlap/menempel di mobile */
    .page-min-height{min-height: calc(100vh - 70px);}
    footer.w-100{margin-top: auto;}

    .page-hero{
        background: linear-gradient(135deg, rgba(10,102,255,.16), rgba(13,78,166,.06));
        border: 1px solid rgba(10,102,255,.20);
        border-radius: 1rem;
        padding: 1.25rem;
        box-shadow: 0 10px 30px rgba(10,102,255,.08);
    }
    .table-modern{margin-bottom:0;}
    .table-modern thead th{
        background: rgba(10,102,255,.12);
        color: var(--ink);
        font-weight: 700;
    }
    .table-modern tbody tr:hover{background: rgba(10,102,255,.06);}
</style>

<div class="container-fluid page-min-height p-0 d-flex flex-column">
    <div class="page-hero mb-4 flex-shrink-0 mx-2 mx-sm-0">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h1 class="m-0" style="color:var(--ink);">List User</h1>
                <div class="text-muted">Ringkasan data pengguna.</div>
            </div>
        </div>
    </div>

    <div class="table-responsive px-2 px-sm-0">
        <table class="table table-striped table-hover align-middle table-modern mb-0">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Email</th>
                    <th scope="col">No Telepon</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">Level User</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $x = 1;
                    $query = "SELECT * FROM user";
                    $data = mysqli_query($connection, $query);
                    while($data_row = mysqli_fetch_assoc($data)){
                        ?>
                        <tr>
                            <th scope="row"><?=$x?></th>
                            <td><?=$data_row['nama']?></td>
                            <td><?=$data_row['alamat']?></td>
                            <td><?=$data_row['email']?></td>
                            <td><?=$data_row['no_telp']?></td>
                            <td>
                                <?php
                                    if($data_row['jenis_kelamin'] == "L"){
                                        echo "Laki-Laki";
                                    } else {
                                        echo "Perempuan";
                                    }
                                ?>
                            </td>
                            <td>
                                <?php if($data_row['role'] == 'admin'){ ?>
                                    <span class="badge bg-danger"><?=$data_row['role']?></span>
                                <?php } else { ?>
                                    <span class="badge bg-primary"><?=$data_row['role']?></span>
                                <?php } ?>
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
</div>


<?php include("template/footer.php"); ?>
