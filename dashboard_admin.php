<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Khabib Yusril</title>
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- feather icons-->
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- style css -->
    <link rel="stylesheet" href="css/admin-dash.css" />
  </head>
  <style>
:root {
  --primary: #006ba8;
  --bg: #010101;
}

.navbar-extra .logout-btn {
    color: white;
    background-color: var(--primary); /* Warna background tombol logout */
    padding: 8px 16px;
    border-radius: 5px;
    text-decoration: none;
    font-weight: bold;
    transition: background-color 0.3s ease;
    margin-left: 15px; /* Memberi jarak dengan elemen lainnya */
}

.navbar-extra .logout-btn:hover {
    background-color: #0056b3; /* Warna background saat di-hover */
}

  </style>
  <body>
    <!-- navbar start -->
    <nav class="navbar">
      <a href="index.php" class="navbar-logo">Dashboard<span>Admin</span>.</a>

      <div class="navbar-extra">
        <!-- Link untuk Logout -->
        <a href="logout.php" class="logout-btn">Logout</a>
      </div>
    </nav>
    <!-- navbar end -->

    <div class="dashboard">
        <a href="cek_pesanan.php">Lihat Pesanan</a>
        <a href="add-product.php">Tambah Produk</a>
    </div>

    <!-- Feather icons script untuk ikon-ikon -->
    <script>
      feather.replace();
    </script>
  </body>
</html>
