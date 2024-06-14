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

    // Query SQL untuk mengambil data kucing dari database berdasarkan ID
    $query = "SELECT * FROM tabel_kucing WHERE id = '$id'";
    $result = mysqli_query($mysqli, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $nama_kucing = $row['nama_kucing'];
        $jenis_kucing = $row['jenis_kucing'];
        $berat = $row['berat'];
        $nama_pemilik = $row['nama_pemilik'];
    } else {
        // Jika data tidak ditemukan, redirect kembali ke halaman kucing.php
        header('Location: kucing.php');
        exit;
    }
} else {
    // Jika ID tidak ditemukan, redirect kembali ke halaman kucing.php
    header('Location: kucing.php');
    exit;
}

// Proses saat form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari form
    $nama_kucing = $_POST['nama_kucing'];
    $jenis_kucing = $_POST['jenis_kucing'];
    $berat = $_POST['berat'];
    $nama_pemilik = $_POST['nama_pemilik'];

    // Query SQL untuk menyimpan data ke database
    $query = "UPDATE tabel_kucing SET nama_kucing='$nama_kucing', jenis_kucing='$jenis_kucing', berat='$berat', nama_pemilik='$nama_pemilik' WHERE id='$id'";

    // Jalankan query
    if (mysqli_query($mysqli, $query)) {
        // Redirect kembali ke halaman kucing.php setelah data berhasil diubah
        header('Location: kucing.php');
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
    <title>Meow Hotel - Edit Data</title>
    <link rel="stylesheet" href="tambah_data.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #333;
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
            <h1>Edit Data Kucing</h1>
        </header>
        <div class="content">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id; ?>" method="post">
                <div class="form-group">
                    <label for="nama_kucing">Nama Kucing:</label>
                    <input type="text" id="nama_kucing" name="nama_kucing" value="<?php echo $nama_kucing; ?>" required>
                </div>
                <div class="form-group">
                    <label for="jenis_kucing">Jenis Kucing:</label>
                    <input type="text" id="jenis_kucing" name="jenis_kucing" value="<?php echo $jenis_kucing; ?>" required>
                </div>
                <div class="form-group">
                    <label for="berat">Berat:</label>
                    <input type="text" id="berat" name="berat" value="<?php echo $berat; ?>" required>
                </div>
                <div class="form-group">
                    <label for="nama_pemilik">Nama Pemilik:</label>
                    <input type="text" id="nama_pemilik" name="nama_pemilik" value="<?php echo $nama_pemilik; ?>" required>
                </div>
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>
