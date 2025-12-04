<?php
// require necessary files
require_once 'inc/config.php';
// check if user is logged in
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
        <div style="text-align:center;"><?php Utility::showFlash(); ?></div>
        <div class="inventory-header">
            <div>
              <a href="create.php" class="btn-add">+ Add New Product</a>
            </div>
            
            <form action="" method="GET" class="search-form">
              <input type="text" name="q" placeholder="Search product..." class="search-input">
              <button type="submit" class="search-btn">Search</button>
            </form>
        </div>
      </div>
      
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Product Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if (empty($Inventory)) {
            echo '<tr><td colspan="8" style="text-align:center;">Belum ada data product.</td></tr>';
          }
          foreach ($Inventory as $inv) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($inv['id']) . '</td>';
            
            //Gambar
            echo '<td>';
            if (!empty($inv['image_path'])) {
                echo '<img src="' . htmlspecialchars($inv['image_path']) . '" class="product-thumbnail">';
            } else {
                echo '<span style="color:grey; font-size:12px;">No Image</span>';
            }
            echo '</td>';

            echo '<td>' . htmlspecialchars($inv['name']) . '</td>';
            echo '<td>' . htmlspecialchars($inv['category']) . '</td>';
            echo '<td>Rp ' . number_format($inv['price'], 0, ',', '.') . '</td>';
            echo '<td>' . htmlspecialchars($inv['stock']) . '</td>';
            
            
            $statusColor = ($inv['status'] == 'active') ? 'green' : 'red';
            echo '<td style="color:'.$statusColor.'; font-weight:bold;">' . ucfirst(htmlspecialchars($inv['status'])) . '</td>';
            
            //Edit
            echo '<td>';
            echo '<a href="edit.php?id=' . $inv['id'] . '" class="btn-action btn-edit">Edit</a>';
            echo '<a href="deleteProduct.php?id=' . $inv['id'] . '" class="btn-action btn-delete">Delete</a>';
            echo '</td>';

            echo '</tr>';
          }
          ?>
        </tbody>
      </table>
    </section>
  </main>
</body>

</html>