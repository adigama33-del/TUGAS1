<?php

// require necessary files
require_once 'inc/config.php';
// check if user is logged in
Utility::checkLogin();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <header>
    <h1>Inventory Warung Madura Bu Aji</h1>
  </header>
  <?php Utility::showNav(); ?>  
  <main>
    <section>
      <h2>Selamat Datang</h2>
      <p>Anda adalah admin yang dapat mengelola inventory warung ini. Kamu dapat mengakses menu navigasi diatas untuk mengelola produk yang ada di inventory warung.</p>
      <p>Data anda:
      <ul>
        <li>ID: <?php echo $_SESSION['user']['id']; ?></li>
        <li>Username: <?php echo $_SESSION['user']['username']; ?></li>
        <li>Name: <?php echo $_SESSION['user']['fullname']; ?></li>
        <li>City: <?php echo $_SESSION['user']['city']; ?></li>
        <li>Join Date: <?php echo $_SESSION['user']['created_at']; ?></li>
        <li>Last Login: <?php echo $_SESSION['user']['last_login']; ?></li>
      </ul>
      </p>
    </section>
  </main>

</body>

</html>