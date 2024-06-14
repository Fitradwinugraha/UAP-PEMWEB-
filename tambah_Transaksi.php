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
    $id_kucing = $_POST['kode_kucing'];
    $tanggal_penitipan = $_POST['tanggal_penitipan'];
    $tanggal_ambil = $_POST['tanggal_ambil'];
    $harga_per_hari = $_POST['harga_per_hari']; // Harga tidak perlu diubah formatnya karena formatnya telah sesuai dengan yang diinginkan
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
            <h1>Tambah Transaksi</h1>
        </header>
        <div class="content">
            <form action="tambah_transaksi.php" method="post">
                <div class="form-group">
                    <label for="kode_kucing">Kode Kucing:</label>
                    <input type="text" id="kode_kucing" name="kode_kucing" required>
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
                    <input type="text" id="harga_per_hari" name="harga_per_hari" placeholder="Masukkan harga per hari" required>
                </div>
                <div class="form-group">
                    <label for="total_harga">Total Harga:</label>
                    <input type="text" id="total_harga" name="total_harga" readonly>
                </div>
                <div class="form-group">
                    <label for="status_pengambilan">Status Pengambilan:</label>
                    <select id="status_pengambilan" name="status_pengambilan" required>
                        <option value="Belum Diambil">Belum Diambil</option>
                        <option value="Sudah Diambil">Sudah Diambil</option>
                    </select>
                </div>
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
    <script>
        document.getElementById("harga_per_hari").addEventListener("input", function() {
            var hargaPerHari = parseFloat(this.value.replace(/\./g, "").replace(/,/g, ""));
            var tanggalPenitipan = new Date(document.getElementById("tanggal_penitipan").value);
            var tanggalAmbil = new Date(document.getElementById("tanggal_ambil").value);
            var selisihHari = Math.ceil((tanggalAmbil - tanggalPenitipan) / (1000 * 60 * 60 * 24));
            var totalHarga = hargaPerHari * selisihHari;
            document.getElementById("total_harga").value = totalHarga.toLocaleString("id-ID");
        });
    </script>
</body>
</html>
