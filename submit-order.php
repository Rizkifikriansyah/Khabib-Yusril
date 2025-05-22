<?php
include 'db.php'; // Koneksi ke database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    
    // Hitung total harga
    $total_price = $price * $quantity;

    // Query untuk menyimpan pesanan ke database
    $query = "INSERT INTO orders (customer_name, phone_number, address, product_name, quantity, total_price, order_date) 
              VALUES ('$name', '$phone', '$address', '$product_name', '$quantity', '$total_price', NOW())";
    
    if (mysqli_query($conn, $query)) {
        // Jika berhasil, arahkan ke halaman success.php
        // Setelah menyimpan pesanan
    $order_id = mysqli_insert_id($conn); // Mendapatkan ID pesanan terbaru
    header("Location: success.php?order_id=" . $order_id);
    exit();

    } else {
        echo "Gagal menyimpan pesanan.";
    }
} else {
    echo "Data tidak lengkap.";
}
?>
