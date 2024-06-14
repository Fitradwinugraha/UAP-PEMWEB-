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
    $namakaryawan = $_POST['namakaryawan'];
    $jeniskelamin = $_POST['jeniskelamin'];
    $notelepon = $_POST['notelepon'];
    $posisi = $_POST['posisi'];

    // Query SQL untuk menyimpan data ke database
    $query = "INSERT INTO karyawan (namakaryawan, jeniskelamin, notelepon, posisi) 
          VALUES ('$namakaryawan', '$jeniskelamin', '$notelepon', '$posisi')";

    // Jalankan query
$result = $mysqli->query($query);
if ($result) {
    // Redirect kembali ke halaman karyawan.php setelah data berhasil ditambahkan
    header('Location: karyawan.php');
    exit;
} else {
    echo "Error: " . $query . "<br>" . $mysqli->error;
}

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meow Hotel - Tambah Data Karyawan</title>
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
            <h1>Tambah Data Karyawan</h1>
        </header>
        <div class="content">
            <form action="tambahkaryawan.php" method="post">
                <div class="form-group">
                    <label for="namakaryawan">Nama Karyawan:</label>
                    <input type="text" id="namakaryawan" name="namakaryawan" required>
                </div>
                <div class="form-group">
                    <label for="jeniskelamin">Jenis Kelamin:</label>
                    <select id="jenis_kelamin" name="jeniskelamin" required>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="notelepon">No Telepon:</label>
                    <input type="text" id="notelepon" name="notelepon" required>
                </div>
                <div class="form-group">
                    <label for="posisi">Posisi:</label>
                    <select id="posisi" name="posisi" required>
                        <option value="grooming">Salon and Grooming</option>
                        <option value="staf media sosial">Staf media sosial</option>
                        <option value="helper">Helper Grooming</option>
                        <option value="penjaga">Penjaga</option>
                    </select>
                </div>
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>
