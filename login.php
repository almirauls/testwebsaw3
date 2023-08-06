<!-- proses login -->

<?php
session_start();
require "config.php";

if(isset($_POST["submit"])){

    $username=$_POST["username"];
    $password=md5($_POST["password"]);

    $sql = "SELECT*FROM user WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);
    $id_user = $_SESSION['id_user'];
    $row = $result->fetch_assoc();

    // jika data ada, maka
    if ($result->num_rows > 0) {
        
        $_SESSION['username'] = $row["username"];
        $_SESSION['level'] = $row["level"];
        $_SESSION['id_user'] = $row['id_user'];
        $_SESSION['status'] = "y";
       header("Location:index.php");

    } else {
        header("Location:?msg=n");
    }
  
}
$conn->close();
?>

<!-- halaman login -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LOGIN</title>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>

<!-- validasi login gagal -->
<?php 
if(isset($_GET['msg'])){
    if($_GET['msg'] == "n"){
    ?>
    <div class="alert alert-danger" align="center">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Login Gagal!</strong>
    </div>
    <?php
    }    
     
}
?>


<!-- <div class="container-fluid" style="margin-top:150px">
    <div class="row">
        <div class="col-lg-4 offset-lg-4"> -->
        <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="index.php" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="assets/images/angkasa-pura.png" style= "width: 250px;" alt="logo-img">
                </a>
                <p class="text-center">HEAVY EQUIPMENT</p>
            <form method="POST">
                <!-- <div class="card border-dark">
                    <div class="card-header bg-info text-light border-dark">
                        <strong>LOGIN</strong> -->
                    </div>
                    <div class="card-body border">
                        <div class="form-group">
                            <label for="">Username</label>
                            <input type="text" class="form-control" name="username" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" class="form-control" name="password" autocomplete="off" required>
                        </div>
                        <input type="submit" class="btn btn-primary btn-user btn-block" name="submit" value="Login">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

 <!-- Body Wrapper
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="index.php" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="assets/images/angkasa-pura.png" style= "width: 240px;" alt="logo-img">
                </a>
                <p class="text-center">HEAVY EQUIPMENT</p>
                <form method="POST">
                <div class="form-group">
                            <label for="">Username</label>
                            <input type="text" class="form-control" name="username" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" class="form-control" name="password" autocomplete="off" required>
                        </div>
                        <input type="submit" class="btn btn-primary btn-user btn-block" name="submit" value="Login"> -->
                <!-- </div>
                <a href="index.php" class="btn btn-primary btn-user btn-block" name="submit" value="Login">
                    Login
                </a>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> -->

<script src="assets/js/jquery-3.7.0.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>