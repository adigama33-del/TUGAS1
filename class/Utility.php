<?php

class Utility
{

    // Redirect to a different page with an optional message and prefill data
    public static function redirect($url, $msg = '', $prefill = []) {
        // set prefill data if provided
        if (!empty($prefill)) {
            $_SESSION['prefill'] = $prefill;
        }

        // set flash message if provided
        if ($msg) {
            $_SESSION['flash']['message'] = $msg;
        }

        // perform redirect
        header("Location: " . BASE_URL . $url);
        exit();
    }

    // Show flash message
    public static function showFlash() {
        if (isset($_SESSION['flash'])) {
            echo '<p class="flash-message">' . $_SESSION['flash']['message'] . '</p>';
            unset($_SESSION['flash']);
        }
    }
    // Check user login status
    public static function checkLogin($login=true) {
        if ($login && !isset($_SESSION['user'])) {
            self::redirect('login.php');
        } elseif (!$login && isset($_SESSION['user'])) {
            self::redirect('index.php');
        }
    }
    // Display navigation menu
    public static function showNav($pages = NAV_PAGES)
    {
        echo '<nav><ul>';
        foreach ($pages as $item) {
            $title = htmlspecialchars($item['title'] ?? '', ENT_QUOTES, 'UTF-8');
            $url   = htmlspecialchars($item['url'] ?? '', ENT_QUOTES, 'UTF-8');
            echo "<li><a href='$url'>$title</a></li>";
        }
        echo '</ul></nav>';
    }
    // Logout user
    public static function logout() {
        unset($_SESSION['user']);
        self::redirect('login.php');
    }
    // Get prefill data for specified keys
    public static function getPrefill($keys = []) {
        $data = [];
        foreach ($keys as $key) {
            $data[$key] = $_SESSION['prefill'][$key] ?? '';
        }
        return $data;
    }
    // Clear prefill data
    public static function clearPrefill() {
        if (isset($_SESSION['prefill'])) {
            unset($_SESSION['prefill']);
        }
    }
}
