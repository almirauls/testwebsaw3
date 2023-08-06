<?php

if(isset($_POST['simpan'])){

    // ambil data
    $id_aset=$_POST['id_aset'];
	$nama_aset=$_POST['nama_aset'];
    $unit=$_POST['unit'];
    
    // validasi data aset (mengecek data yang tidak boleh sama)
    $sql = "SELECT*FROM aset WHERE id_aset='$id_aset'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>ID Aset sudah terdaftar</strong>
            </div>
        <?php
    }else{

	// proses simpan data aset
        $sql = "INSERT INTO aset VALUES ('$id_aset','$nama_aset','$unit')";
        if ($conn->query($sql) === TRUE) {
            header("Location:?page=aset");
        }
    }
}
?>

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                <div class="card-header bg-primary text-white border-dark"><strong>INPUT DATA ASET</strong></div>
                <div class="card-body">

                    <div class="form-group">
                        <label for="">ID Aset</label>
                        <input type="text" class="form-control" name="id_aset" maxlength="50" required>
                    </div>

                    <div class="form-group">
                        <label for="">Nama Aset</label>
                        <input type="text" class="form-control" name="nama_aset" maxlength="50" required>
                    </div>

                    <div class="form-group">
                        <label for="">Unit</label>
                        <input type="text" class="form-control" name="unit" maxlength="50" required>
                    </div>

                    <input class="btn btn-primary" type="submit" name="simpan" value="Simpan">
                    <a class="btn btn-danger" href="?page=aset">Batal</a>

                </div>
            </div>
        </form>
    </div>
</div>