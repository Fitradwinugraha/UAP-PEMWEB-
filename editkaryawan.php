0<?php
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

    // Query SQL untuk mengambil data pemilik dari database berdasarkan ID
    $query = "SELECT * FROM karyawan WHERE id_karyawan = '$id'";
    $result = mysqli_query($mysqli, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $namakaryawan = $row['namakaryawan'];
        $jeniskelamin = $row['jeniskelamin'];
        $posisi = $row['posisi'];
        $notelepon = $row['notelepon'];
    } else {
        // Jika data tidak ditemukan, redirect kembali ke halaman karyawan.php
        header('Location: karyawan.php');
        exit;
    }
} else {
    // Jika ID tidak ditemukan, redirect kembali ke halaman karyawan.php
    header('Location: karyawan.php');
    exit;
}

// Proses saat form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari form
    $namakaryawan = $_POST['namakaryawan'];
    $jeniskelamin = $_POST['jeniskelamin'];
    $posisi = $_POST['posisi'];
    $notelepon = $_POST['notelepon'];

    // Query SQL untuk mengupdate data di database
    $query = "UPDATE karyawan SET namakaryawan='$namakaryawan', jeniskelamin='$jeniskelamin', posisi='$posisi', notelepon='$notelepon' WHERE id_karyawan='$id'";

    // Jalankan query
    if (mysqli_query($mysqli, $query)) {
        // Redirect kembali ke halaman karyawan.php setelah data berhasil diubah
        header('Location: karyawan.php');
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
    <title>Meow Hotel - Edit Karyawan</title>
    <link rel="stylesheet" href="tambah_data.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="main-content">
        <header>
            <h1>Edit Data Karyawan</h1>
        </header>
        <div class="content">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id; ?>" method="post">
                <div class="form-group">
                    <label for="namakaryawan">Nama Karyawan:</label>
                    <input type="text" id="namakaryawan" name="namakaryawan" value="<?php echo $namakaryawan; ?>" required>
                </div>
                <div class="form-group">
                    <label for="jeniskelamin">Jenis Kelamin:</label>
                    <select id="jenis_kelamin" name="jeniskelamin"  required>
                    <option value="Laki Laki" <?php if ($jeniskelamin == 'Laki Laki') echo 'selected'; ?>>Laki-Laki</option>
                    <option value="perempuan"<?php if ($jeniskelamin == 'perempuan') echo 'selected'; ?>>Perempuan</option> 
                    </select>
                </div>
                <div class="form-group">
                    <label for="notelepon">No Telepon:</label>
                    <input type="text" id="notelepon" name="notelepon" value="<?php echo $notelepon; ?>" required>
                </div>
                <div class="form-group">
                    <label for="posisi">Posisi:</label>
                    <select class="form-select" id="posisi" name="posisi" required>
                    <option value="salon grooming"<?php if ($posisi == 'salon and grooming') echo 'selected'; ?>>Salon and Grooming</option>
                    <option value="staf media sosial"<?php if ($posisi == 'staf media sosial') echo 'selected'; ?>>Staf media sosial</option> 
                    <option value="helper grooming"<?php if ($posisi == 'helper grooming') echo 'selected'; ?>>Helper Grooming</option> 
                    <option value="penjaga"<?php if ($posisi == 'penjaga') echo 'selected'; ?>>Penjaga</option> 
                    </select>
                </div>
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>

