<?php
require_once 'inc/config.php';
Utility::checkLogin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Add Product</h1>
    </header>
    <main>
        <section>
            <form action="saveProduct.php" method="post" enctype="multipart/form-data" id="form-products">
                <div class="row">
                    <label for="name">Nama Produk:</label>
                    <input type="text" id="name" name="name" required placeholder="Contoh: Beras 5kg">
                </div>

                <div class="row">
                    <label for="category">Kategori:</label>
                    <select id="category" name="category" required>
                        <option value="" disabled selected>Pilih Kategori</option>
                        <option value="Sembako">Sembako</option>
                        <option value="Minuman">Minuman</option>
                        <option value="Makanan Ringan">Makanan Ringan</option>
                        <option value="Rokok">Rokok</option>
                        <option value="Perlengkapan Mandi">Perlengkapan Mandi</option>
                        <option value="Lain-lain">Lain-lain</option>
                    </select>
                </div>

                <div class="row">
                    <label for="price">Harga (Rp):</label>
                    <input type="number" id="price" name="price" required min="0" placeholder="Masukkan Harga">
                </div>

                <div class="row">
                    <label for="stock">Stok Awal:</label>
                    <input type="number" id="stock" name="stock" required min="0" placeholder="Masukkan stok satuannya">
                </div>

                <div class="row">
                    <label for="image">Foto Produk:</label>
                    <input type="file" id="image" name="image" accept="image/*" required>
                    <br><small style="margin-left: 125px; color: grey;">Format: JPG, PNG, GIF</small>
                </div>

                <div class="row">
                    <label for="status">Status:</label>
                    <select id="status" name="status">
                        <option value="active">Active (Dijual)</option>
                        <option value="inactive">Inactive (Disimpan)</option>
                    </select>
                </div>

                <hr>
                <div class="row"><?php Utility::showFlash(); ?></div>
                <div class="row">
                    <button type="submit">Save Product</button>
                    <a href="inventory.php" class="btn-action btn-cancel">Batal</a>
                </div>
            </form>
        </section>
    </main>
</body>
</html>