<?php
// require necessary files
require_once 'inc/config.php';
// check if product is logged in
Utility::checkLogin();

// load all Inventory
$product = new Products();
$Inventory = $product->getAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inventory</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <header>
    <h1>Inventory</h1>
  </header>
  <?php Utility::showNav(); ?>
  <main>
    <section>
      <div>
        <h2>Inventory Table</h2>
        <div class="inventory-update">
            <div id="update-links">
              <a href="create.php">Add</a>
              <a href="edit.php">Edit</a>
              <a href="">Delete</a>
            </div>
            <form action="">
              <input type="text" placeholder="Search...">
              <button type="submit">Search</button>
            </form>
        </div>
      </div>
      <div class="row"></div>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Product Name</th>
            <th>category</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Status</th>
            <th>&nbsp;</th>
          </tr>
        </thead>
        <tbody>
          <!-- Show Inventory data -->
          <?php
          if (empty($Inventory)) {
            echo '<tr><td colspan="6">Belum ada data product.</td></tr>';
          }
          foreach ($Inventory as $inventory) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($inventory['id']) . '</td>';
            echo '<td>' . htmlspecialchars($inventory['image_path']) . '</td>';
            echo '<td>' . htmlspecialchars($inventory['name']) . '</td>';
            echo '<td>' . htmlspecialchars($inventory['category']) . '</td>';
            echo '<td>' . htmlspecialchars($inventory['price']) . '</td>';
            echo '<td>' . htmlspecialchars($inventory['stock']) . '</td>';
            echo '<td>' . htmlspecialchars($inventory['status']) . '</td>';
            echo '<td>&nbsp;</td>';
            echo '</tr>';
          }
          ?>
        </tbody>
      </table>
    </section>
  </main>
</body>

</html>