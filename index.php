<?php
include 'db.php'; // Koneksi ke database

// Initialize the query
$query = "SELECT * FROM products";

// Check if a search term is provided
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $query .= " WHERE name LIKE '%$search%'";
}

$result = mysqli_query($conn, $query);
?>

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
    <link rel="stylesheet" href="css/index.css" />
  </head>
  <body>
    <!-- navbar start -->
    <nav class="navbar">
      <a href="#" class="navbar-logo">Khabib<span>Yusril</span>.</a>
      <div class="navbar-nav">
        <a href="#">Home</a>
        <a href="#about">Tentang</a>
        <a href="#menu">Menu</a>
      </div>

      <div class="navbar-extra">
        <!-- Search bar added here -->
        <form method="GET" action="" class="search-form">
                <input type="text" name="search" placeholder="Cari produk..." class="search-input" required />
                <button type="submit" id="search-btn"><i data-feather="search"></i></button>
            </form>
        <a href="#" id="hamburger-menu"><i data-feather="menu"></i></a>
      </div>
    </nav>
    <!-- navbar end -->

    <!-- hero section start -->
    <section class="hero" id="home">
      <main class="content">
        <h1>Selamat Datang Di Website Khabib <span>Yusril</span></h1>
        <h3>
          Anda bisa melihat bebrapa informasi produk yang kami jual pada website
          ini
        </h3>
        <a href="detail.php" class="cta">Menu Kami</a>
      </main>
    </section>
    <!-- hero section end -->

    <!-- about section start -->
    <section id="about" class="about">
      <h2><span>Tentang</span> Kami</h2>

      <div class="row">
        <div class="about-img">
          <img src="img/tentang-kami.jpeg" alt="Tentang Kami" />
        </div>
        <div class="content">
          <h3>Kenapa Memilih Produk Kami?</h3>
          <p>
          Selamat datang di Khabib Yusril, pusat penjualan makanan olahan berkualitas yang siap memanjakan lidah Anda. Kami menyediakan berbagai pilihan abon dan bandeng presto yang diolah secara higienis dan menggunakan bahan-bahan terbaik.
          </p>
        </div>
      </div>
    </section>
    <!-- about section end -->

    <!-- menu section start -->
    <section id="menu" class="menu">
        <h2><span>Menu</span> Kami</h2>
        <p>Berikut adalah produk-produk kami:</p>

        <div class="row">
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="menu-card">
                <img src="img/menu/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>" class="menu-card-img">
                <h3 class="menu-card-title"><?php echo $row['name']; ?></h3>
                <p class="menu-card price">IDR. <?php echo number_format($row['price']); ?></p>
                <p><?php echo $row['description']; ?></p>
                <a href="order.php?product_id=<?php echo $row['id']; ?>" class="cta">Beli Sekarang</a>
            </div>
            <?php endwhile; ?>
        </div>
    </section>
    <!-- menu section end -->
    <!-- footer start -->
    <footer>
      <div class="socials">
        <a href="https://www.instagram.com/kyy2ez/?hl=en"
          ><i data-feather="instagram"></i
        ></a>
        <a href="#"><i data-feather="facebook"></i></a>
        <a href="https://wa.me/qr/MOLWMNOP7DXZM1"
          ><i data-feather="phone"></i
        ></a>
      </div>

      <div class="credit">
        <p>Created By <a href="login-admin.php">RizkiFikriansyah</a>. | &copy; 2024</p>
      </div>
    </footer>
    <!-- footer end -->

    <!-- feather icons-->
    <script>
      feather.replace();
    </script>

    <!-- my javascript-->
    <script src="js/script.js"></script>
  </body>
</html>
