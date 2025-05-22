<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}
include 'db.php'; // Pastikan file ini berisi koneksi ke database

// Query untuk mengambil semua pesanan
$query = "SELECT * FROM orders ORDER BY order_date DESC";
$result = mysqli_query($conn, $query);

// Query untuk menghitung total pembelian dalam 1 hari
$query_day = "SELECT SUM(total_price) AS total_day FROM orders WHERE order_date >= CURDATE()";
$result_day = mysqli_query($conn, $query_day);
$total_day = mysqli_fetch_assoc($result_day)['total_day'];

// Query untuk menghitung total pembelian dalam 1 minggu
$query_week = "SELECT SUM(total_price) AS total_week FROM orders WHERE order_date >= DATE_SUB(CURDATE(), INTERVAL 1 WEEK)";
$result_week = mysqli_query($conn, $query_week);
$total_week = mysqli_fetch_assoc($result_week)['total_week'];

// Query untuk menghitung total pembelian dalam 1 bulan
$query_month = "SELECT SUM(total_price) AS total_month FROM orders WHERE order_date >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
$result_month = mysqli_query($conn, $query_month);
$total_month = mysqli_fetch_assoc($result_month)['total_month'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Cek Pesanan</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap"
      rel="stylesheet"
    />
    <style>
        :root {
            --primary: #006ba8;
            --bg: #010101;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: var(--bg);
            padding: 20px;
            text-align: center;
            color: white;
        }

        .navbar-logo {
            color: white;
            font-size: 24px;
            text-decoration: none;
        }

        .navbar-logo span {
            font-weight: bold;
            color: var(--primary);
        }

        h2, h3 {
            text-align: center;
            margin-top: 30px;
            font-weight: 400;
        }

        .totals {
            width: 80%;
            margin: 20px auto;
            padding: 10px;
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-around;
        }

        .total-item {
            text-align: center;
            font-size: 18px;
            color: #333;
        }

        table {
            width: 80%;
            margin: 30px auto;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: var(--primary);
            color: white;
        }

        td {
            border-bottom: 1px solid #ddd;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        @media (max-width: 768px) {
            table {
                width: 100%;
                font-size: 14px;
            }

            th, td {
                padding: 10px;
            }

            h2, h3 {
                font-size: 18px;
            }

            .totals {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="dashboard_admin.php" class="navbar-logo">Dashboard<span>Admin</span>.</a>
    </nav>

    <h2>Daftar Pesanan Customer</h2>

    <!-- Total Pembelian -->
    <div class="totals">
        <div class="total-item">
            <h3>Total Hari Ini:</h3>
            <p>IDR <?php echo number_format($total_day, 2); ?></p>
        </div>
        <div class="total-item">
            <h3>Total Minggu Ini:</h3>
            <p>IDR <?php echo number_format($total_week, 2); ?></p>
        </div>
        <div class="total-item">
            <h3>Total Bulan Ini:</h3>
            <p>IDR <?php echo number_format($total_month, 2); ?></p>
        </div>
    </div>

    <!-- Tabel untuk menampilkan pesanan -->
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>ID Pesanan</th>
                <th>Nama Customer</th>
                <th>No. Handphone</th>
                <th>Alamat</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
                <th>Tanggal Pesan</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['customer_name']; ?></td>
                        <td><?php echo $row['phone_number']; ?></td>
                        <td><?php echo $row['address']; ?></td>
                        <td><?php echo $row['product_name']; ?></td>
                        <td><?php echo $row['quantity']; ?></td>
                        <td>IDR <?php echo number_format($row['total_price'], 2); ?></td>
                        <td><?php echo $row['order_date']; ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8">Belum ada pesanan.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
