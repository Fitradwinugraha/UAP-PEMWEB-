<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meow Hotel - Transaksi</title>
    <link rel="icon" type="image/png" href="img/meow.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            width: 100%;
            overflow: hidden;
        }

        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
        }

        .sidebar {
            width: 200px;
            background-color: #fff;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            border-right: 2px solid #ddd;
            height: 100vh;
            position: fixed; /* Fix the sidebar to the left */
            
        }

        .main-content {
            flex: 1;
            margin-top: 50px; 
            margin-left: 200px; /* Offset for the fixed sidebar */
            display: flex;
            flex-direction: column;
            background-color: #f1f1f1;
            height: 100vh;
            overflow-y: auto; /* Enable scrolling if content overflows */
            padding: 20px;
            box-sizing: border-box;
        }

        header {
            background-color: #333;
            color: #ffd700;
            padding: 20px;
            font-size: 24px;
            display: flex;
            align-items: center;
            width: 100%;
            box-sizing: border-box;
            position: fixed;
            top: 0;
            left: 200px; 
            z-index: 900;
        }

        .logo {
            width: 150px;
            height: 150px;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
            margin-top: -90px;
        }

        nav ul li {
            margin: 30px 15px;
        }

        nav ul li a {
            text-decoration: none;
            color: #333;
            font-weight: 600;
        }

        .logout {
            background-color: #333;
            color: #ffd700;
            padding: 5px;
            border: none;
            cursor: pointer;
            font-size: 18px;
            font-family: 'Poppins', sans-serif;
            margin: 60px 0 0 0;
            border-radius: 10px;
            width: 100%;
        }

        .add-data {
        background-color: #333;
        color: #ffd700;
        padding: 10px 20px;
        border: none;
        cursor: pointer;
        font-size: 16px;
        font-family: 'Poppins', sans-serif;
        border-radius: 5px;
        }

        .search {
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 5px;
        }

        table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background-color: #fff; /* Background color for table */
        }

        table th, table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
        background-color: #fff; /* Background color for table cells */
        }

        table th {
        background-color: #333;
        color: #ffd700;
        }

        .edit, .delete {
        background: none;
        border: none;
        cursor: pointer;
        font-size: 18px;
        }

        .edit {
        color: #333;
        }

        .delete {
        color: #f00;
        }   

        .top-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        }
        .content {
        padding: 20px;
        }   

    </style>
</head>
<body>
    <div class="sidebar">
        <img src="img/MEOW.PNG" alt="Meow Hotel Logo" class="logo">
        <nav>
            <ul>
            <li><a href="dashboard.php"><img src="img/dashboard.png" alt="Dashboard" style="width: 20px; height: 20px; margin-right: 10px;">Dashboard</a></li>
                <li><a href="kucing.php"><img src="img/happy.png" alt="" style="width: 20px; height: 20px; margin-right: 10px;">Kucing</a></li>
                <li><a href="pemilik.php"><img src="img/pet.png" alt="" style="width: 20px; height: 20px; margin-right: 10px;">Pemilik</a></li>
                <li><a href="transaksi.php"><img src="img/invoice.png" alt="" style="width: 20px; height: 20px; margin-right: 10px;">Transaksi</a></li>
                <li><a href="karyawan.php"><img src="img/employee.png" alt="" style="width: 20px; height: 20px; margin-right: 10px;">Karyawan</a></li>
            </ul>
        </nav>
        <button class="logout" onclick="location.href='login.php'">Logout</button>
    </div>
    <div class="main-content">
        <header>
            <div class="menu-toggle">Transaksi</div>
        </header>
        <div class="content">
            <div class="top-bar">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET">
                    <input type="text" class="search" name="keyword" placeholder="Search" value="<?php echo isset($_GET['keyword']) ? $_GET['keyword'] : ''; ?>">
                    <button type="submit"><i class="fas fa-search"></i></button>
                </form>
                <button class="add-data" onclick="location.href='tambah_transaksi.php'">+ Tambah Data</button>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Kode Kucing</th>
                        <th>Tanggal Penitipan</th>
                        <th>Tanggal Pengambilan</th>
                        <th>Harga/Hari</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Include koneksi ke database
                    include "konfigurasi.php";

                    // Query SQL untuk mengambil data transaksi dari database berdasarkan kata kunci pencarian
                    if (isset($_GET['keyword']) && !empty($_GET['keyword'])) {
                        $keyword = mysqli_real_escape_string($mysqli, $_GET['keyword']);
                        $query = "SELECT * FROM tabel_transaksi 
                                  WHERE id_kucing LIKE '%$keyword%' 
                                  OR tanggal_penitipan LIKE '%$keyword%' 
                                  OR tanggal_ambil LIKE '%$keyword%' 
                                  OR harga_per_hari LIKE '%$keyword%' 
                                  OR total_harga LIKE '%$keyword%' 
                                  OR status_pengambilan LIKE '%$keyword%'";
                    } else {
                        // Query SQL untuk mengambil semua data transaksi jika tidak ada kata kunci pencarian
                        $query = "SELECT * FROM tabel_transaksi";
                    }

                    // Eksekusi kueri
                    $result = mysqli_query($mysqli, $query);

                    // Perulangan untuk menampilkan data transaksi dalam tabel
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['id_kucing'] . "</td>";
                        echo "<td>" . $row['tanggal_penitipan'] . "</td>";
                        echo "<td>" . $row['tanggal_ambil'] . "</td>";
                        echo "<td>" . $row['harga_per_hari'] . "</td>";
                        echo "<td>" . $row['total_harga'] . "</td>";
                        echo "<td>" . $row['status_pengambilan'] . "</td>";
                        echo "<td>";
                        echo "<button class='edit' onclick='editData(" . $row['id'] . ")'><i class='fas fa-edit'></i></button>";
                        echo "<button class='delete' onclick='deleteData(" . $row['id'] . ")'><i class='fas fa-trash-alt'></i></button>";
                        echo "<button class='print' onclick='printData(" . $row['id'] . ")'><i class='fas fa-print'></i></button>"; // Added print button
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function deleteData(id) {
            if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                window.location.href = "hapus_transaksi.php?id=" + id;
            }
        }

        function editData(id) {
            window.location.href = "edit_transaksi.php?id=" + id;
        }

        function printData(id) {
            window.location.href = "cetak.php?id=" + id; // Added printData function
        }
    </script>
</body>
</html>