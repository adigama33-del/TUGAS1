<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Start session
session_start();
// simple autoload
spl_autoload_register(function ($class_name) {
    include 'class/' . $class_name . '.php';
});
// database config
const DB_HOST = 'localhost';
const DB_USER = 'root';       // sesuaikan dengan user MySQL Anda
const DB_PASS = 'Nanimo33.';   // sesuaikan dengan password MySQL Anda
const DB_NAME = 'warung_madura';   // sesuaikan dengan nama database yang sudah dibuat
// Define base URL
const BASE_URL = 'http://localhost:8000/'; // sesuaikan dengan nama folder

// navigasi config
const NAV_PAGES = [
    ['title' => 'Home',    'url' => 'index.php'],
    ['title' => 'tambah',     'url' => 'create.php'],
    ['title' => 'Profile', 'url' => 'profile.php'],
    ['title' => 'Admin', 'url' =>  'admin.php'],
    ['title' => 'Login',  'url' => 'login.php'],    
    ['title' => 'Logout',  'url' => 'logout.php']
];
