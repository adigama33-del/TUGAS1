<?php
require_once 'inc/config.php';
Utility::checkLogin();


$id = $_GET['id'] ?? null;


$product = new Products();
if (!$id || !$product->setById($id)) {
    Utility::redirect('inventory.php', 'Produk tidak ditemukan.');
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Produk</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header><h1>Edit Produk</h1></header>
    <?php Utility::showNav(); ?>
    <main>
        <section>
            <?php Utility::showFlash(); ?>

            <form action="saveProduct.php" method="post" enctype="multipart/form-data">
                
                <input type="hidden" name="id" value="<?= $product->getId() ?>">

                <div class="row">
                    <label>Nama Produk:</label>
                    <input type="text" name="name" value="<?= htmlspecialchars($product->name) ?>" required>
                </div>

                <div class="row">
                    <label>Kategori:</label>
                    <select name="category" required>
                        <?php
                        $cats = ['Sembako', 'Minuman', 'Makanan Ringan', 'Rokok', 'Perlengkapan Mandi', 'Lain-lain'];
                        foreach ($cats as $c) {
                            $selected = ($product->category == $c) ? 'selected' : '';
                            echo "<option value='$c' $selected>$c</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="row">
                    <label>Harga (Rp):</label>
                    <input type="number" name="price" value="<?= $product->getPrice() ?>" required>
                </div>

                <div class="row">
                    <label>Stok:</label>
                    <input type="number" name="stock" value="<?= $product->getStock() ?>" required>
                </div>

                <div class="row">
                    <label>Foto Produk:</label>
                    <?php if ($product->image_path): ?>
                        <div style="margin-bottom: 10px;">
                            <img src="<?= $product->image_path ?>" style="width: 100px; border: 1px solid #ccc;">
                            <br><small>Foto saat ini</small>
                        </div>
                    <?php endif; ?>
                    
                    <input type="file" name="image" accept="image/*">
                    <br><small style="color: grey;">Biarkan kosong jika tidak ingin mengganti foto.</small>
                </div>

                <div class="row">
                    <label>Status:</label>
                    <select name="status">
                        <option value="active" <?= $product->getStatus() == 'active' ? 'selected' : '' ?>>Active (Dijual)</option>
                        <option value="inactive" <?= $product->getStatus() == 'inactive' ? 'selected' : '' ?>>Inactive (Disimpan)</option>
                    </select>
                </div>

                <hr>
                <div class="row">
                    <button type="submit">Update Produk</button>
                    <a href="inventory.php" class="btn-action btn-cancel">Batal</a>
                </div>
            </form>
        </section>
    </main>
</body>
</html>