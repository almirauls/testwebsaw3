<?php 

$id_user=$_GET['id_user'];

if(isset($_POST['update'])){

    // mengambil data dari masing-masing input
    $username = $_POST['username'];
    $password = MD5($_POST['password']);
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];
    $level=$_POST['level'];

    // proses update data user
    $sql = "UPDATE user SET username='$username', password='$password', alamat='$alamat', telepon='$telepon', level='$level' WHERE id_user='$id_user'";
    if ($conn->query($sql) === TRUE) {
        header("Location:?page=user");
    }
}

// memanggil data dan memasukkan ke masing-masing input
// $id_user=$_GET['id_user'];

$sql = "SELECT*FROM user WHERE id_user='$id_user'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                <div class="card-header bg-primary text-white border-dark"><strong>UPDATE DATA USER</strong></div>
                    <div class="card-body">

                <!-- id_user di lock karena primary key -->
                <div class="form-group">
                    <label for="">Username</label>
                    <input type="text" class="form-control" value="<?php echo $row["username"]?>" name="username" maxlength="50" required>
                </div>

                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" class="form-control" name="password" maxlength="50">
                </div>

                <div class="form-group">
                    <label for="">Alamat</label>
                    <input type="text" class="form-control" value="<?php echo $row["alamat"]?>" name="alamat" maxlength="150" required>
                </div>

                <div class="form-group">
                    <label for="">Telepon</label>
                    <input type="text" class="form-control" value="<?php echo $row["telepon"]?>" name="telepon" maxlength="50" required>
                </div>

                <div class="form-group">
                        <label for="">Level</label>
                        <select class="form-control chosen" data-placeholder="Pilih Level" name="level">
                            <option value="<?php echo $row["level"]?>"><?php echo $row["level"]?></option>
                            <option value="Manager">Manager</option>
                            <option value="Senior Teknisi">Senior Teknisi</option>
                            <option value="Teknisi">Teknisi</option>
                            <option value="Staff Teknisi">Staff Teknisi</option>
                        </select>
                    </div>

                <input class="btn btn-primary" type="submit" name="update" value="Update">
                <a class="btn btn-danger" href="?page=user">Batal</a>

                </div>
            </div>
        </form>
    </div>
</div>