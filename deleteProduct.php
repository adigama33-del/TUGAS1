<?php
require_once 'inc/config.php';
Utility::checkLogin();

$id = $_GET['id'] ?? null;

if (!$id) {
    Utility::redirect('inventory.php', 'ID Produk tidak valid.');
}

$product = new Products();

if ($product->setById($id)) {
    
    
    if ($product->delete()) {
        Utility::redirect('inventory.php', 'Produk berhasil dihapus.');
    } else {
        Utility::redirect('inventory.php', 'Gagal menghapus produk dari database.');
    }

} else {
    Utility::redirect('inventory.php', 'Produk tidak ditemukan.');
}