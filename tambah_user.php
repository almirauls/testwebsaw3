<?php

if(isset($_POST['simpan'])){

    // ambil data dari input
    $username=$_POST["username"];
    $password=MD5($_POST['password']);
	$alamat=$_POST['alamat'];
    $telepon=$_POST['telepon'];
    $level=$_POST['level'];
    
    // validasi data user (mengecek data yang tidak boleh sama)
    $sql = "SELECT * FROM user WHERE username='$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Username sudah digunakan</strong>
            </div>
        <?php
    }else{

	// proses simpan data user
    $sql = "INSERT INTO user VALUES (Null, '$username', '$password', '$alamat', '$telepon', '$level')";
        if ($conn->query($sql) === TRUE) {
            header("Location:?page=user");
        }
    }
}
?>


<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                <div class="card-header bg-primary text-white border-dark"><strong>INPUT DATA USER</strong></div>
                <div class="card-body">

                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" class="form-control" name="username" maxlength="50" required>
                    </div>

                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" class="form-control" name="password" maxlength="50" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="">Alamat</label>
                        <input type="text" class="form-control" name="alamat" maxlength="150" required>
                    </div>

                    <div class="form-group">
                        <label for="">Telepon</label>
                        <input type="text" class="form-control" name="telepon" maxlength="50" required>
                    </div>

                    <div class="form-group">
                        <label for="">Level</label>
                        <select class="form-control chosen" data-placeholder="Pilih Level" name="level">
                            <option value="Manager">Manager</option>;
                            <option value="Senior Teknisi">Senior Teknisi</option>;
                            <option value="Teknisi">Teknisi</option>;
                            <option value="Staff Teknisi">Staff Teknisi</option>;
                        </select>
                    </div>

                    <input class="btn btn-primary" type="submit" name="simpan" value="Simpan">
                    <a class="btn btn-danger" href="?page=penjadwalan">Batal</a>

                </div>
            </div>
        </form>
    </div>
</div>