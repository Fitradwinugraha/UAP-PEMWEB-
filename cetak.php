<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f9f9f9;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .header {
            text-align: center;
        }
        .logo {
            max-width: 100px;
            margin-bottom: 20px;
        }
        h1 {
            color: #333;
        }
        p {
            font-size: 16px;
            color: #555;
        }
        p strong {
            color: #333;
        }
    </style>
    <script>
        window.onload = function() { window.print(); }
    </script>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="MEOW.PNG" alt="Meow Hotel Logo" class="logo">
            <h1>Detail Transaksi</h1>
        </div>
        <?php
        include "konfigurasi.php";

        // Memastikan ID transaksi sudah diberikan
        if (isset($_GET['id'])) {
            $id = mysqli_real_escape_string($mysqli, $_GET['id']);

            // Query untuk mendapatkan data transaksi berdasarkan ID
            $query = "SELECT * FROM tabel_transaksi WHERE id = '$id'";
            $result = mysqli_query($mysqli, $query);

            if ($row = mysqli_fetch_assoc($result)) {
                // Menampilkan data transaksi dalam format cetak
                echo "<p><strong>ID Kucing:</strong> " . $row['id_kucing'] . "</p>";
                echo "<p><strong>Tanggal Penitipan:</strong> " . $row['tanggal_penitipan'] . "</p>";
                echo "<p><strong>Tanggal Pengambilan:</strong> " . $row['tanggal_ambil'] . "</p>";
                echo "<p><strong>Harga/Hari:</strong> " . $row['harga_per_hari'] . "</p>";
                echo "<p><strong>Total Harga:</strong> " . $row['total_harga'] . "</p>";
                echo "<p><strong>Status:</strong> " . $row['status_pengambilan'] . "</p>";
            } else {
                echo "<p>Data tidak ditemukan.</p>";
            }
        } else {
            echo "<p>ID transaksi tidak diberikan.</p>";
        }
        ?>
    </div>
</body>
</html>