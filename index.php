<?php
date_default_timezone_set("Asia/Jakarta");
session_start();
require "config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Penjadwalan A2B</title>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/datatables.min.css">
    <link rel="stylesheet" href="assets/css/all.css">
    <link rel="stylesheet" href="assets/css/bootstrap-chosen.css">

    <style>
        /* CSS for the sidebar menu */
        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #3975ed;
            padding-top: 60px;
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
            margin-top: 20px;
        }

        .sidebar ul li {
            padding: 10px;
            border-bottom: 1px solid #ffffff;
        }

        .sidebar ul li:last-child {
            border-bottom: none;
        }

        .sidebar ul li a {
            color: #fff;
            text-decoration: none;
        }

        .sidebar ul li.active {
            background-color: #3975ed;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0px;
            width: 100%;
        }

        .sidebar-brand img {
            width: 180px;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }
    </style>
</head>
<body>

<!-- cek status login atau belum -->
<?php 
    if($_SESSION['status']!="y"){
    header("Location:login.php");
    }
?>

<div class="sidebar">
    <a class="sidebar-brand" href="index.php">
        <img src="assets/images/angkasa-pura.png" alt="logo-img">
    </a>

    <ul>
        <li><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
        <?php
        if ($_SESSION['level'] == "Manager") {
            ?>
            <li><a href="?page=user"><i class="fas fa-user"></i> User</a></li>
            <li><a href="?page=aset"><i class="fas fa-truck"></i> Aset</a></li>
            <li><a href="?page=perangkingan&tgl_jadwal="><i class="fas fa-tasks"></i> Akses Jadwal</a></li>
            <li><a href="?page=print"><i class="fas fa-print"></i> Cetak Jadwal</a></li>
            <?php
        } elseif ($_SESSION['level'] == "Teknisi" || $_SESSION['level'] == "Staff Teknisi") {
            ?>
            <li><a href="?page=perangkingan&tgl_jadwal="><i class="fas fa-tasks"></i> Akses Jadwal</a></li>
            <li><a href="?page=edit&tgl_jadwal="><i class="fas fa-edit"></i> Update Jadwal</a></li>
            <li><a href="?page=print"><i class="fas fa-print"></i> Cetak Jadwal</a></li>
            <?php
        } else {
            ?>
            <li><a href="?page=user"><i class="fas fa-user"></i> User</a></li>
            <li><a href="?page=aset"><i class="fas fa-truck"></i> Aset</a></li>
            <li><a href="?page=pembobotan"><i class="fas fa-cogs"></i> Pengaturan Bobot</a></li>
            <li><a href="?page=penjadwalan"><i class="fas fa-cog"></i> Pengaturan Kriteria</a></li>
            <li><a href="?page=perangkingan&tgl_jadwal="><i class="fas fa-tasks"></i> Akses Jadwal</a></li>
            <li><a href="?page=edit&tgl_jadwal="><i class="fas fa-edit"></i> Update Jadwal</a></li>
            <li><a href="?page=print"><i class="fas fa-print"></i> Cetak Jadwal</a></li>
            <?php
        }
        ?>
        <li><a href="?page=logout"><i class="fas fa-door-closed"></i> Logout</a></li>
    </ul>
</div>

<!-- Content Area -->
<div class="content">
    <?php

    // Pengaturan Menu
    $page = isset($_GET['page']) ? $_GET['page'] : "";
    $action = isset($_GET['action']) ? $_GET['action'] : "";

    if ($page == "") {
        include "welcome.php";
    } elseif ($page == "aset") {
        if ($action == "") {
            include "tampil_aset.php";
        } elseif ($action == "tambah") {
            include "tambah_aset.php";
        } elseif ($action == "update") {
            include "update_aset.php";
        } else {
            include "hapus_aset.php";
        }
    } elseif ($page == "pembobotan") {
        if ($action == "") {
            include "update_bobot.php";
        } elseif ($action == "update") {
            include "update_bobot.php";
        } else {
        }
    } elseif ($page == "penjadwalan") {
        if ($action == "") {
            include "tampil_penjadwalan.php";
        } elseif ($action == "tambah") {
            include "tambah_penjadwalan.php";
        } elseif ($action == "update") {
            include "update_penjadwalan.php";
        } else {
            include "hapus_penjadwalan.php";
        }
    } elseif ($page == "perangkingan") {
        if ($action == "") {
            include "perangkingan.php";
        // } elseif ($action == "update") {
        //     include "edit_jadwal.php";
        }
    } elseif ($page == "sort") {
        if ($action == "") {
            include "filter.php";
        // } elseif ($action == "update") {
        //     include "edit_jadwal.php";
        }
    } elseif ($page == "edit") {
        if ($action == "") {
            include "lihat_jadwal.php";
        } elseif ($action == "update") {
            include "edit_jadwal.php";
        }
    } elseif ($page == "user") {
        if ($action == "") {
            include "tampil_user.php";
        } elseif ($action == "tambah") {
            include "tambah_user.php";
        } elseif ($action == "update") {
            include "update_user.php";
        } else {
            include "hapus_user.php";
        }
    } elseif ($page == "print") {
        if ($action == "") {
            include "cetak_jadwal.php";
        }
    } else {
        if ($action == "") {
            include "logout.php";
        }

    }
    ?>
</div>

<!-- Add your scripts and other body elements here -->
<script src="assets/js/jquery-3.7.0.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/all.js"></script>
<script src="assets/js/datatables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#myTable').dataTable();
    });
</script>

<script src="assets/js/chosen.jquery.min.js"></script>
<script>
    $(function () {
        $('.chosen').chosen();
     });
    </script>

</body>
</html>
