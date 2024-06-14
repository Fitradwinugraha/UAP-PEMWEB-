<?php
session_start();

// Cek jika pengguna tidak login, maka arahkan kembali ke halaman login
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header('Location: login.php');
    exit;
}

// Include koneksi ke database
include "konfigurasi.php";

// Periksa apakah ID data dikirim melalui parameter URL
if (isset($_GET['id'])) {
    // Escape data yang diterima dari parameter URL
    $id = mysqli_real_escape_string($mysqli, $_GET['id']);

    // Query SQL untuk mengambil data transaksi dari database berdasarkan ID
    $query = "SELECT * FROM tabel_transaksi WHERE id = '$id'";
    $result = mysqli_query($mysqli, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $id_kucing = $row['id_kucing'];
        $tanggal_penitipan = $row['tanggal_penitipan'];
        $tanggal_ambil = $row['tanggal_ambil'];
        $harga_per_hari = $row['harga_per_hari'];
        $status_pengambilan = $row['status_pengambilan'];
    } else {
        // Jika data tidak ditemukan, redirect kembali ke halaman transaksi.php
        header('Location: transaksi.php');
        exit;
    }
} else {
    // Jika ID tidak ditemukan, redirect kembali ke halaman transaksi.php
    header('Location: transaksi.php');
    exit;
}

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

    // Query SQL untuk mengupdate data di database
    $query = "UPDATE tabel_transaksi SET id_kucing='$id_kucing', tanggal_penitipan='$tanggal_penitipan', tanggal_ambil='$tanggal_ambil', harga_per_hari='$harga_per_hari', total_harga='$total_harga', status_pengambilan='$status_pengambilan' WHERE id='$id'";

    // Jalankan query
    if (mysqli_query($mysqli, $query)) {
        // Redirect kembali ke halaman transaksi.php setelah data berhasil diubah
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
    <title>Meow Hotel - Edit Transaksi</title>
    <link rel="stylesheet" href="tambah_data.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="main-content">
        <header>
            <h1>Edit Transaksi</h1>
        </header>
        <div class="content">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id; ?>" method="post">
                <div class="form-group">
                    <label for="id_kucing">ID Kucing:</label>
                    <input type="text" id="id_kucing" name="id_kucing" value="<?php echo $id_kucing; ?>" required>
                </div>
                <div class="form-group">
                    <label for="tanggal_penitipan">Tanggal Penitipan:</label>
                    <input type="date" id="tanggal_penitipan" name="tanggal_penitipan" value="<?php echo $tanggal_penitipan; ?>" required>
                </div>
                <div class="form-group">
                    <label for="tanggal_ambil">Tanggal Ambil:</label>
                    <input type="date" id="tanggal_ambil" name="tanggal_ambil" value="<?php echo $tanggal_ambil; ?>" required>
                </div>
                <div class="form-group">
                    <label for="harga_per_hari">Harga/Hari:</label>
                    <input type="text" id="harga_per_hari" name="harga_per_hari" value="<?php echo $harga_per_hari; ?>" required>
                </div>
                <div class="form-group">
                    <label for="total_harga">Total Harga:</label>
                    <input type="text" id="total_harga" name="total_harga" readonly>
                </div>
                <div class="form-group">
                    <label for="status_pengambilan">Status Pengambilan:</label>
                    <select id="status_pengambilan" name="status_pengambilan" required>
                        <option value="Belum Diambil" <?php if ($status_pengambilan == 'Belum Diambil') echo 'selected'; ?>>Belum Diambil</option>
                        <option value="Sudah Diambil" <?php if ($status_pengambilan == 'Sudah Diambil') echo 'selected'; ?>>Sudah Diambil</option>
                    </select>
                </div>
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
    <script>
        function updateTotalHarga() {
            var hargaPerHari = parseFloat(document.getElementById("harga_per_hari").value.replace(/\./g, "").replace(/,/g, ""));
            var tanggalPenitipan = new Date(document.getElementById("tanggal_penitipan").value);
            var tanggalAmbil = new Date(document.getElementById("tanggal_ambil").value);
            var selisihHari = Math.ceil((tanggalAmbil - tanggalPenitipan) / (1000 * 60 * 60 * 24));
            var totalHarga = hargaPerHari * selisihHari;
            document.getElementById("total_harga").value = isNaN(totalHarga) ? "" : totalHarga.toLocaleString("id-ID");
        }

        document.getElementById("harga_per_hari").addEventListener("input", updateTotalHarga);
        document.getElementById("tanggal_penitipan").addEventListener("input", updateTotalHarga);
        document.getElementById("tanggal_ambil").addEventListener("input", updateTotalHarga);

        // Initialize the total price on page load
        window.onload = updateTotalHarga;
    </script>
</body>
</html>
