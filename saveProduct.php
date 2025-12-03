<?php
require_once 'inc/config.php';
 Utility::checkLogin(); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = $_POST['name'] ?? '';
    $category = $_POST['category'] ?? '';
    $price    = $_POST['price'] ?? 0;
    $stock    = $_POST['stock'] ?? 0;
    $status   = $_POST['status'] ?? 'active';

    $imagePath = null;

    //Upload gambar
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        
        $fileName = time() . '_' . basename($_FILES['image']['name']);
        $targetFile = $uploadDir . $fileName;
        
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        
        if (in_array($fileType, $allowedTypes)) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                $imagePath = $targetFile;
            } else {
                Utility::redirect('create.php', 'Gagal mengupload gambar.');
            }
        } else {
            Utility::redirect('create.php', 'Format file tidak didukung. Gunakan JPG, PNG, atau GIF.');
        }
    } else {
        Utility::redirect('create.php', 'Wajib upload foto produk.');
    }

    
    $product = new Products();
    $product->name = $name;
    $product->category = $category;
    $product->setPrice($price);
    $product->setStock($stock);
    $product->image_path = $imagePath;
    $product->setStatus($status);

    if ($product->save()) {
        Utility::redirect('create.php', 'Produk berhasil ditambahkan.');
    } else {
        if ($imagePath && file_exists($imagePath)) {
            unlink($imagePath);
        }
        Utility::redirect('create.php', 'Gagal menyimpan data ke database.');
    }
}