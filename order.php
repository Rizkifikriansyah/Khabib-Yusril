<?php
include 'db.php'; // Koneksi ke database

// Cek apakah product_id dikirim melalui URL
if (isset($_GET['product_id'])) {
    $product_id = mysqli_real_escape_string($conn, $_GET['product_id']);

    // Query untuk mengambil detail produk berdasarkan ID
    $product_query = "SELECT * FROM products WHERE id = '$product_id'";
    $product_result = mysqli_query($conn, $product_query);
    
    // Jika produk ditemukan
    if (mysqli_num_rows($product_result) > 0) {
        $product = mysqli_fetch_assoc($product_result);
    } else {
        echo "Produk tidak ditemukan.";
        exit;
    }
} else {
    echo "Product ID tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pemesanan</title>
    <link rel="stylesheet" href="css/order.css">
</head>
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
</style>
<body>
    <div class="container">
        <h1>Form Pemesanan</h1>
        <p>Produk: <?php echo $product['name']; ?></p>
        <p>Harga: IDR. <?php echo number_format($product['price']); ?></p>

        <!-- Form untuk mengisi informasi pemesanan -->
        <form action="submit-order.php" method="POST">
            <!-- Kirimkan nama produk melalui form -->
            <input type="hidden" name="product_name" value="<?php echo $product['name']; ?>">
            <input type="hidden" name="price" value="<?php echo $product['price']; ?>">

            <label for="name">Nama:</label>
            <input type="text" id="name" name="name" required>

            <label for="phone">Nomor HP:</label>
            <input type="text" id="phone" name="phone" required>

            <label for="address">Alamat:</label>
            <textarea id="address" name="address" required></textarea>

            <label for="quantity">Jumlah Pesanan:</label>
            <input type="number" id="quantity" name="quantity" min="1" required>

            <button type="submit">Pesan Sekarang</button>
        </form>
    </div>
</body>
</html>
