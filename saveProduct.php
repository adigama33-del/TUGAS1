<?php
require_once 'inc/config.php';
Utility::checkLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    
    $product = new Products();
    
    if ($id) {
        $product->setById($id); 
    }

    $product->name = $_POST['name'];
    $product->category = $_POST['category'];
    $product->setPrice($_POST['price']);
    $product->setStock($_POST['stock']);
    $product->setStatus($_POST['status'] ?? 'active');

    //Gambar
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';

        $fileName = time() . '_' . basename($_FILES['image']['name']);
        $targetFile = $uploadDir . $fileName;
        
        $ext = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                // Hapus gambar lama
                if ($product->image_path && file_exists($product->image_path)) {
                    unlink($product->image_path);
                }

                $product->image_path = $targetFile;
            }
        }
    }
    
    if ($product->save()) {
        Utility::redirect('inventory.php', 'Data berhasil disimpan!');
    } else {
        Utility::redirect('inventory.php', 'Gagal menyimpan data.');
    }
}