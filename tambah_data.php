<?php
session_start();

// Cek jika pengguna tidak login, maka arahkan kembali ke halaman login
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header('Location: login.html');
    exit;
}

// Include koneksi ke database
include "konfigurasi.php";

// Proses saat form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari form
    $id_kucing = $_POST['id_kucing'];
    $tanggal_penitipan = $_POST['tanggal_penitipan'];
    $tanggal_ambil = $_POST['tanggal_ambil'];
    $harga_per_hari = $_POST['harga_per_hari'];
    $status_pengambilan = $_POST['status_pengambilan'];

    // Hitung total harga
    $tanggal_awal = new DateTime($tanggal_penitipan);
    $tanggal_akhir = new DateTime($tanggal_ambil);
    $selisih_hari = $tanggal_awal->diff($tanggal_akhir)->days;
    $total_harga = $selisih_hari * $harga_per_hari;

    // Query SQL untuk menyimpan data ke database
    $query = "INSERT INTO tabel_transaksi (id_kucing, tanggal_penitipan, tanggal_ambil, harga_per_hari, total_harga, status_pengambilan) 
              VALUES ('$id_kucing', '$tanggal_penitipan', '$tanggal_ambil', '$harga_per_hari', '$total_harga', '$status_pengambilan')";

    // Jalankan query
    if (mysqli_query($mysqli, $query)) {
        // Redirect kembali ke halaman transaksi.php setelah data berhasil ditambahkan
        header('Location: transaksi.php');
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
    <title>Meow Hotel - Tambah Transaksi</title>
    <link rel="stylesheet" href="tambah_data.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="main-content">
        <header>
            <h1>Tambah Transaksi</h1>
        </header>
        <div class="content">
            <form action="tambah_transaksi.php" method="post">
                <div class="form-group">
                    <label for="id_kucing">ID Kucing:</label>
                    <select id="id_kucing" name="id_kucing" required>
                        <option value="10">10</option>
                        <option value="12">12</option>
                        <option value="14">14</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tanggal_penitipan">Tanggal Penitipan:</label>
                    <input type="date" id="tanggal_penitipan" name="tanggal_penitipan" required>
                </div>
                <div class="form-group">
                    <label for="tanggal_ambil">Tanggal Ambil:</label>
                    <input type="date" id="tanggal_ambil" name="tanggal_ambil" required>
                </div>
                <div class="form-group">
                    <label for="harga_per_hari">Harga/Hari:</label>
                    <input type="text" id="harga_per_hari" name="harga_per_hari" placeholder="Rp" required>
                </div>
                <div class="form-group">
                    <label for="status_pengambilan">Status Pengambilan:</label>
                    <input type="text" id="status_pengambilan" name="status_pengambilan">
                </div>
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>
