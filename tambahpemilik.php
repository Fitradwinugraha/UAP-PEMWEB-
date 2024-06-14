<?php
session_start();

// Cek jika pengguna tidak login, maka arahkan kembali ke halaman login
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header('Location: login.php');
    exit;
}

// Include koneksi ke database
include "konfigurasi.php";

// Proses saat form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari form
    $nama_pemilik = $_POST['nama_pemilik'];
    $no_telepon = $_POST['no_telepon'];
    $alamat = $_POST['alamat'];
   
    // Query SQL untuk menyimpan data ke database
    $query = "INSERT INTO pemilik (nama_pemilik, no_telepon, alamat) VALUES ('$nama_pemilik', '$no_telepon', '$alamat')";

    // Jalankan query
    if (mysqli_query($mysqli, $query)) {
        // Redirect kembali ke halaman pemilik.php setelah data berhasil ditambahkan
        header('Location: pemilik.php');
        exit;
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meow Hotel - Tambah Data</title>
    <link rel="stylesheet" href="tambah_data.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #333;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }

        .main-content {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        header {
            text-align: center;
            margin-bottom: 30px;
        }

        h1 {
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="text"], select, option {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif; 
        }

        button[type="submit"] {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-family: 'Poppins', sans-serif; 
        }

        button[type="submit"]:hover {
            background-color: #555;
        }

    </style>
</head>
<body>
    
    <div class="main-content">
        <header>
            <h1>Tambah Data Pemilik</h1>
        </header>
        <div class="content">
            <form action="tambahpemilik.php" method="post">
                <div class="form-group">
                    <label for="nama_pemilik">Nama Pemilik:</label>
                    <input type="text" id="nama_pemilik" name="nama_pemilik" required>
                </div>
                <div class="form-group">
                    <label for="no_telepon">No Telepon:</label>
                    <input type="text" id="no_telepon" name="no_telepon" required>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat:</label>
                    <input type="text" id="alamat" name="alamat" required>
                </div>
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>
