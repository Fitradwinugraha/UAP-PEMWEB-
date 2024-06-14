<?php
// Include koneksi ke database
include "koneksi.php";

// Periksa apakah ID data dikirim melalui parameter URL
if (isset($_GET['id'])) {
    // Escape data yang diterima dari parameter URL
    $id = mysqli_real_escape_string($mysqli, $_GET['id']);

    // Query SQL untuk menghapus data dari database berdasarkan ID
    $query = "DELETE FROM tabel_kucing WHERE id = '$id'";

    // Jalankan query
    if (mysqli_query($mysqli, $query)) {
        // Redirect kembali ke halaman kucing.php setelah data berhasil dihapus
        header('Location: kucing.php');
        exit;
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
    }
} else {
    // Jika ID tidak ditemukan, redirect kembali ke halaman kucing.php
    header('Location: kucing.php');
    exit;
}
?>
