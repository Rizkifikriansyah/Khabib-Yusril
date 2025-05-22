<?php
session_start();
include 'db.php'; // Pastikan file ini berisi koneksi ke database

// Pastikan `order_id` ada di URL
if (!isset($_GET['order_id'])) {
    echo "ID pesanan tidak ditemukan!";
    exit();
}

$order_id = $_GET['order_id'];

// Ambil data pesanan berdasarkan order_id
$query = "SELECT * FROM orders WHERE id = '$order_id'";
$result = mysqli_query($conn, $query);
$order = mysqli_fetch_assoc($result);

// Cek apakah data pesanan ditemukan
if (!$order) {
    echo "Pesanan tidak ditemukan!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Berhasil</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-image: url('img/header-bg.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.85);
            padding: 50px;
            border-radius: 10px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 80%;
            max-width: 600px;
        }

        h1 {
            color: #4CAF50;
            font-size: 2.5em;
            margin-bottom: 20px;
        }

        .nota {
            text-align: left;
            font-size: 1em;
            color: #333;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .nota h2 {
            font-size: 1.5em;
            color: #4CAF50;
            text-align: center;
        }

        .nota-item {
            margin: 10px 0;
        }

        .print-btn, .back-btn {
            text-decoration: none;
            color: white;
            background-color: #4CAF50;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 1.1em;
            transition: background-color 0.3s ease;
            margin: 10px;
        }

        .print-btn:hover, .back-btn:hover {
            background-color: #45a049;
        }

        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }

            h1 {
                font-size: 2em;
            }

            .nota h2 {
                font-size: 1.3em;
            }

            .print-btn, .back-btn {
                font-size: 1em;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Pesanan Anda Berhasil!</h1>
        <p>Terima kasih sudah memesan. Kami akan segera memproses pesanan Anda.</p>

        <!-- Nota Pesanan -->
        <div class="nota">
            <h2>Nota Pesanan</h2>
            <div class="nota-item"><strong>Nama Customer:</strong> <?php echo htmlspecialchars($order['customer_name']); ?></div>
            <div class="nota-item"><strong>No. Handphone:</strong> <?php echo htmlspecialchars($order['phone_number']); ?></div>
            <div class="nota-item"><strong>Alamat:</strong> <?php echo htmlspecialchars($order['address']); ?></div>
            <div class="nota-item"><strong>Produk:</strong> <?php echo htmlspecialchars($order['product_name']); ?></div>
            <div class="nota-item"><strong>Jumlah:</strong> <?php echo htmlspecialchars($order['quantity']); ?></div>
            <div class="nota-item"><strong>Total Harga:</strong> IDR <?php echo number_format($order['total_price'], 2); ?></div>
            <div class="nota-item"><strong>Tanggal Pesan:</strong> <?php echo htmlspecialchars($order['order_date']); ?></div>
        </div>

        <!-- Tombol Cetak -->
        <a href="javascript:void(0);" onclick="window.print();" class="print-btn">Cetak Nota</a>
        <a href="index.php" class="back-btn">Kembali ke Beranda</a>
    </div>
</body>
</html>
