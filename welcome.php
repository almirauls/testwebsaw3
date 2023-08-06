<?php

// Check if the user is logged in and retrieve their user ID
if (isset($_SESSION['id_user'])) {
    $id_user = $_SESSION['id_user']; // Assume the user ID is stored in the session, adjust this based on your authentication logic

    // $id_user=$_GET['id_user'];
    // Check if the form is submitted for profile update

    if (isset($_POST['update'])) {
        // Get the data from the input fields
        $password = $_POST['password'];
        $passwordx = MD5($password);
        $alamat = $_POST['alamat'];
        $telepon = $_POST['telepon'];

        // Perform update query to update user profile data
        if ($password == "") {
            $sql = "UPDATE user 
            SET alamat='$alamat', telepon='$telepon' WHERE id_user='$id_user'";    
        } else {
            $sql = "UPDATE user 
            SET alamat='$alamat', telepon='$telepon', password='$passwordx' WHERE id_user='$id_user'";
        }
        if ($conn->query($sql) === TRUE) {
            // cetak notifikasi bahwa data sudah diupdate
?>
            <script>alert('Data sudah disimpan.');</script>
 <?PHP
            //   header("Location: welcome.php"); // Redirect the user to the profile page after successful update
            // exit(); // Make sure to exit after redirecting to avoid further execution of the script
        // } else {
            // Handle the update error if needed
            // For debugging purposes, you can use: echo "Error: " . $conn->error;
        }
    }

    // Fetch user data and populate the input fields
    $sql = "SELECT * FROM user WHERE id_user='$id_user'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    }
    // // Check if user data exists before using it
//    if ($result && $result->num_rows > 0) {
//        $row = $result->fetch_assoc();
//    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Add your meta tags, CSS, and other head elements here -->
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-12 text-center" style="font-family: Arial;">
            <img src="assets/images/angkasa-pura.png" alt="logo" style="width: 300px;">
            <h5 style="font-family: Arial, sans-serif; font-size: 18px;">
            <?php
				if(isset($_SESSION['username'])){  //jika if(!isset($_SESSION['name'] sudah diset nilainya maka
                echo '<span style="font-family: Arial; font-weight: bold; font-size: 20px;">Halo, ' . $_SESSION['username'] . '!</span>'; // akan muncul nama dari user yang login
				} else {
			
				}
				?>
                </h5>
                <h5></h5>
            <h5>Selamat Datang di Sistem Penjadwalan Maintenance</h5>
            <h5>Alat-alat Berat (A2B) Angkasa Pura 1, Bandar Udara Sams Sepinggan Balikpapan</h5>
            <h1></h1>
        </div>
    </div>
</div>

<!-- HTML Form for editing user profile -->
<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                    <div class="card-header bg-primary text-white border-dark"><strong>Profil User</strong></div>
                    <div class="card-body">
                        <!-- Username field (Read-only) -->
                        <div class="form-group">
                            <label for="">Username</label>
                            <input type="text" class="form-control" value="<?php echo $row["username"]?>"
                                   readonly>
                        </div>
                        <!-- Password field (You can add a link to change password if needed) -->
                        <div class="form-group">
                            <label for="">Password (Bila kosong atau tidak diisi, maka tetap menggunakan password yang lama)</label>
                            <input type="password" class="form-control" name="password" value="" maxlength="50" autocomplete="off">
                        </div>
                        <!-- Alamat field -->
                        <div class="form-group">
                            <label for="">Alamat</label>
                            <input type="text" class="form-control"
                                   value="<?php echo $row["alamat"]?>" name="alamat"
                                   maxlength="150" required>
                        </div>
                        <!-- Telepon field -->
                        <div class="form-group">
                            <label for="">Telepon</label>
                            <input type="text" class="form-control"
                                   value="<?php echo $row["telepon"]?>" name="telepon"
                                   maxlength="50" required>
                        </div>

                        <!-- Submit and Cancel Buttons -->
                        <input class="btn btn-primary" type="submit" name="update" value="Update">
                        <a class="btn btn-danger" href="?page=user">Batal</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>