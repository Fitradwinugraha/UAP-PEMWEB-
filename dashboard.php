<?php
session_start();

    // Koneksi ke database
    include 'konfigurasi.php';

   
    $query_jumlah_kucing = "SELECT COUNT(*) AS jumlah_kucing FROM tabel_kucing";
    $result_jumlah_kucing = mysqli_query($mysqli, $query_jumlah_kucing);
    if ($result_jumlah_kucing) {
        $row_jumlah_kucing = mysqli_fetch_assoc($result_jumlah_kucing);
        $jumlah_kucing = isset($row_jumlah_kucing['jumlah_kucing']) ? $row_jumlah_kucing['jumlah_kucing'] : 0;
    } else {
        $jumlah_kucing = 0;
    }

    $query_jumlah_transaksi = "SELECT COUNT(*) AS jumlah_transaksi FROM tabel_transaksi";
    $result_jumlah_transaksi = mysqli_query($mysqli, $query_jumlah_transaksi);
    if ($result_jumlah_transaksi) {
        $row_jumlah_transaksi = mysqli_fetch_assoc($result_jumlah_transaksi);
        $jumlah_transaksi = isset($row_jumlah_transaksi['jumlah_transaksi']) ? $row_jumlah_transaksi['jumlah_transaksi'] : 0;
    } else {
        $jumlah_transaksi = 0;
    }

    $query_jumlah_pemilik = "SELECT COUNT(*) AS jumlah_pemilik FROM pemilik";
    $result_jumlah_pemilik = mysqli_query($mysqli, $query_jumlah_pemilik);
    if ($result_jumlah_pemilik) {
        $row_jumlah_pemilik = mysqli_fetch_assoc($result_jumlah_pemilik);
        $jumlah_pemilik = isset($row_jumlah_pemilik['jumlah_pemilik']) ? $row_jumlah_pemilik['jumlah_pemilik'] : 0;
    } else {
        $jumlah_pemilik = 0;
    }

    $query_jumlah_karyawan = "SELECT COUNT(*) AS jumlah_karyawan FROM karyawan";
    $result_jumlah_karyawan = mysqli_query($mysqli, $query_jumlah_karyawan);
    if ($result_jumlah_karyawan) {
        $row_jumlah_karyawan = mysqli_fetch_assoc($result_jumlah_karyawan);
        $jumlah_karyawan = isset($row_jumlah_karyawan['jumlah_karyawan']) ? $row_jumlah_karyawan['jumlah_karyawan'] : 0;
    } else {
        $jumlah_karyawan = 0;
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meow Hotel - Dashboard</title>
    <link rel="icon" type="image/png" href="img/meow.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            width: 100%;
            overflow: hidden;
        }

        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
        }

        .sidebar {
            width: 200px;
            background-color: #fff;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            border-right: 2px solid #ddd;
            height: 100vh;
            position: fixed;
            
        }

        .main-content {
            flex: 1;
            margin-top: 50px; 
            margin-left: 200px; 
            display: flex;
            flex-direction: column;
            background-color: #f1f1f1;
            height: 100vh;
            overflow-y: auto; 
            padding: 20px;
            box-sizing: border-box;
        }

        header {
            background-color: #333;
            color: #ffd700;
            padding: 15px;
            font-size: 24px;
            display: flex;
            align-items: center;
            width: 100%;
            box-sizing: border-box;
            position: fixed;
            top: 0;
            left: 200px; 
            z-index: 900;
        }

        .logo {
            width: 150px;
            height: 150px;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
            margin-top: -90px;
        }

        nav ul li {
            margin: 30px 15px;
        }

        nav ul li a {
            text-decoration: none;
            color: #333;
            font-weight: 600;
        }

        .logout {
            background-color: #333;
            color: #ffd700;
            padding: 5px;
            border: none;
            cursor: pointer;
            font-size: 18px;
            font-family: 'Poppins', sans-serif;
            margin: 60px 0 0 0;
            border-radius: 10px;
            width: 100%;
        }
        
    </style>
</head>
<body>
    <div class="sidebar">
        <img src="img/MEOW.PNG" alt="Meow Hotel Logo" class="logo">
        <nav>
            <ul>
                <li><a href="#"><img src="img/dashboard.png" alt="Dashboard" style="width: 20px; height: 20px; margin-right: 10px;">Dashboard</a></li>
                <li><a href="kucing.php"><img src="img/happy.png" alt="" style="width: 20px; height: 20px; margin-right: 10px;">Kucing</a></li>
                <li><a href="pemilik.php"><img src="img/pet.png" alt="" style="width: 20px; height: 20px; margin-right: 10px;">Pemilik</a></li>
                <li><a href="transaksi.php"><img src="img/invoice.png" alt="" style="width: 20px; height: 20px; margin-right: 10px;">Transaksi</a></li>
                <li><a href="karyawan.php"><img src="img/employee.png" alt="" style="width: 20px; height: 20px; margin-right: 10px;">Karyawan</a></li>
            </ul>
        </nav>
        <button class="logout" onclick="location.href='login.php'">Logout</button>
    </div>
    <div class="main-content">
        <header class="header mb-5">
            
            <p>Dashboard</p>
            <img src="img/user.png" alt="" style ="width:30px; height:auto; margin-left: 1130px;">
        </header>
        <div class="card mb-5 " style ="margin-top:40px;">
            <div class="row g-0">
                <div class="col-md-2">
                    <img src="img/meong.jpg" class="img" alt="Meong" style="width:200px; height:auto; margin-left:30px;">
                </div>
                <div class="col-md-7">
                    <div class="card-body">
                        <p class="card-title" style="font-weight:600; font-size: 26px; margin-left:30px;">Miaaww, Selamat Datang!</p><br>
                        <p class="card-text" style ="margin-left:30px;">Meow Hotel adalah layanan yang menyediakan tempat tinggal sementara untuk kucing ketika
                                             pemiliknya tidak dapat merawatnya,misalnya saat bepergian atau dalam situasi tertentu yang 
                                             memerlukan perawatan tambahan .</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3 mb-3">
                <div class="card" style = "border-left: 5px solid #333;">
                    <div class="card-body">
                        <p class="card-title" style = "font-weight:bold; color:#333;">Data Kucing<p>
                        <img src="img/smile.png" alt="Pet" style="width: 40px; height: 40px; float: right;">
                        <p class="card-text" style ="padding-top:30px; font-size:20px; color:#DEBF1D;"><?php echo $jumlah_kucing; ?></p>
                        
                    </div>
                </div>
            </div>
            <div class="col-sm-3 mb-3">
                <div class="card" style = "border-left: 5px solid #ffd700;">
                    <div class="card-body">
                    <p class="card-title" style = "font-weight:bold; color:#333;">Transaksi</p>
                    <img src="img/bill.png" alt="Pet" style="width: 40px; height: 40px; float: right;">
                        <p class="card-text" style ="padding-top:40px; font-size:20px;"><?php echo $jumlah_transaksi; ?></p>
                    
                    </div>
                </div>
            </div>
            <div class="col-sm-3 mb-3">
                <div class="card" style = "border-left: 5px solid #333;">
                    <div class="card-body">
                        <p class="card-title" style = "font-weight:bold; color:#333;">Data Pemilik<p>
                        <img src="img/adoption.png" alt="Pet" style="width: 40px; height: 40px; float: right;"> 
                        <p class="card-text" style ="padding-top:30px; font-size:20px; color:#DEBF1D;"><?php echo $jumlah_pemilik; ?></p>
                        
                    </div>
                </div>
            </div>
            <div class="col-sm-3 mb-3">
                <div class="card" style = "border-left: 5px solid #ffd700;">
                    <div class="card-body">
                        <p class="card-title" style = "font-weight:bold; color:#333;">Data Karyawan<p>
                        <img src="img/employee.png" alt="Pet" style="width: 40px; height: 40px; float: right;">
                        <p class="card-text" style ="padding-top:30px; font-size:18px;"><?php echo $jumlah_karyawan; ?></p>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
