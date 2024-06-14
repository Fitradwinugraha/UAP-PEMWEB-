<?php
session_start();

// Cek jika pengguna tidak login, maka arahkan kembali ke halaman login
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header('Location: login.html');
    exit;
}

// Include koneksi ke database
include "konfigurasi.php";

// Pastikan parameter id_transaksi terdefinisi dan merupakan angka
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    // Ambil ID transaksi dari URL
    $id_transaksi = $_GET['id'];

    // Query SQL untuk menghapus data transaksi dari database berdasarkan ID
    $query = "DELETE FROM tabel_transaksi WHERE id = $id_transaksi";

    // Jalankan query
    if (mysqli_query($mysqli, $query)) {
        // Redirect kembali ke halaman transaksi.php setelah data berhasil dihapus
        header('Location: transaksi.php');
        exit;
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
    }
} else {
    echo "ID transaksi tidak valid!";
    exit;
}
?>
