<?php 

if(isset($_POST['update'])){

    // mengambil data dari masing-masing input
    $id_aset=$_POST['id_aset'];
    $nama_aset=$_POST['nama_aset'];
    $unit=$_POST['unit'];

    // proses update data aset
    $sql = "UPDATE aset SET nama_aset='$nama_aset',unit='$unit' WHERE id_aset='$id_aset'";
    if ($conn->query($sql) === TRUE) {
        header("Location:?page=aset");
    }
}

// memanggil data dan memasukkan ke masing-masing input
$id_aset=$_GET['id_aset'];

$sql = "SELECT * FROM aset WHERE id_aset='$id_aset'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                <div class="card-header bg-primary text-white border-dark"><strong>UPDATE DATA ASET</strong></div>
                    <div class="card-body">

                <!-- ID Aset di lock karena primary key -->
                <div class="form-group">
                    <label for="">ID Aset</label>
                    <input type="text" class="form-control" value="<?php echo $row["id_aset"]?>" name="id_aset" readonly>
                </div>

                <div class="form-group">
                    <label for="">Nama Aset</label>
                    <input type="text" class="form-control" value="<?php echo $row["nama_aset"]?>" name="nama_aset" maxlength="50" required>
                </div>

                <div class="form-group">
                    <label for="">Unit</label>
                    <input type="text" class="form-control" value="<?php echo $row["unit"]?>" name="unit" maxlength="50" required>
                </div>

                <input class="btn btn-primary" type="submit" name="update" value="Update">
                <a class="btn btn-danger" href="?page=aset">Batal</a>

                </div>
            </div>
        </form>
    </div>
</div>