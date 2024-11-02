<?php include_once('headerpasien.php');
require_once "../config/config.php";
?>

<div class="main-content">
    <section class="section">
        <div class="section-header text-center">
            <div class="col-lg-12 col-md-6 col-sm-6 col-12">
                <h1>Halaman Gizi Buruk</h1><br>
            </div>


        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4> </h4>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0 admin" id="admin">
                                <thead>
                                    <tr>
                                        <th>No</th>

                                        <th>Gizi Buruk</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $SqlQuery = mysqli_query($con, "SELECT * From penyakit inner join pasien as p on penyakit.id_pasien=p.id_pasien where p.id_pasien");
                                    $no = 1;
                                    if (mysqli_num_rows($SqlQuery) > 0) {
                                        while ($row = mysqli_fetch_array($SqlQuery)) {
                                    ?>
                                            <tr>
                                                <td><?= $no++ ?></td>

                                                <td><?= $row['nama_penyakit'] ?></td>



                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan=\"8\" align=\"center\">data tidak ada</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>


    </section>
</div>
<!-- MODAL -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Penyakit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <div class="form-group">
                        <div class="section-title mt-0">Pilih Pasien</div>
                        <div class="input-group mb-2">
                            <select class="custom-select" name="namapasien" required>
                                <option disabled selected> Nama Pasien</option>
                                <?php

                                $sql2 = mysqli_query($con, "SELECT * FROM pasien ");
                                while ($row2 = mysqli_fetch_array($sql2)) {
                                ?>
                                    <option value="<?= $row2['id_pasien'] ?>"><?= $row2['nama_pasien'] ?></option>
                                <?php

                                }

                                ?>

                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="section-title mt-0">Nama Penyakit</div>
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" name="namapenyakit" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="section-title mt-0">Solusi</div>
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" name="solusi" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary mr-1" type="submit" name="submit">Simpan</button>

                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

                    </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div>

<?php
if (isset($_POST['submit'])) {
    $namapasien = $_POST['namapasien'];
    $namapenyakit = $_POST['namapenyakit'];
    $solusi = $_POST['solusi'];


    $save = mysqli_query($con, "INSERT INTO penyakit VALUES ('', '$namapasien',  '$namapenyakit', '$solusi' )") or die(mysqli_error($con));

    echo "<script type='text/javascript'>
    setTimeout(function () { 
        swal({ 
            title: 'Suksess', 
            text: 'Data Berhasil Disimpan', 
            type: 'success',
             timer: 3000,
              showConfirmButton: false });
    },10);  
    window.setTimeout(function(){ 
      window.location.replace('index.php');
    } ,3000); 
    </script>";
}
?>


</section>
</div>
<script>
    $(document).ready(function() {
        $('.admin').DataTable();
    });
</script>
<script>
    // swall
    $('.delete-data').on('click', function(e) {
        e.preventDefault();
        var getLink = $(this).attr('href');

        Swal.fire({
            title: 'Apa Anda Yakin?',
            text: "Data akan dihapus permanen",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.value) {
                window.location.href = getLink;
            }
        })
    });
</script>
</body>

</html>


<?php include_once('footer.php');
