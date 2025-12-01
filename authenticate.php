<?php

// require necessary files
require_once 'inc/config.php';
// process login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $user = new User();
    if ($user->authenticate($username, $password)) {
        // redirect to index page on success
        Utility::clearPrefill();
        Utility::redirect('index.php');
    } else {
        // redirect back to login on failure with message
        Utility::redirect('login.php', 'Invalid username or password.', ['username' => $username]);
    }
}
// redirect back to login when accessed directly
Utility::redirect('login.php');
