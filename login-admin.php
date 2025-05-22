<?php
session_start();
include 'db.php'; // Connect to the database

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Encrypt the password using MD5

    // Check if admin credentials are correct
    $query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['admin'] = $username;
        header('Location: dashboard_admin.php'); // Redirect to admin dashboard
    } else {
        echo "<script>alert('Invalid login credentials');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Login</title>
    <style>
      body {
        font-family: 'Poppins', sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        background-image: url('img/header-bg.jpg'); /* Ganti dengan URL atau path gambar yang Anda miliki */
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
      }

      form {
        background-color: white;
        padding: 40px;
        border-radius: 8px;
        box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        width: 300px;
        text-align: center;
      }

      h2 {
        margin-bottom: 20px;
        font-size: 24px;
        color: #333;
      }

      input[type="text"], input[type="password"] {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 4px;
      }

      button {
        width: 100%;
        padding: 10px;
        background-color: #4CAF50;
        border: none;
        color: white;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
      }

      button:hover {
        background-color: #45a049;
      }

      @media (max-width: 768px) {
        form {
          width: 90%;
          padding: 20px;
        }

        h2 {
          font-size: 20px;
        }

        button {
          font-size: 14px;
        }
      }
    </style>
  </head>
  <body>
    <form method="post" action="">
        <h2>Admin Login</h2>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="submit">Login</button>
    </form>
  </body>
</html>
