<?php
// require necessary files
require_once 'inc/config.php';
// check if user is logged in
// Utility::checkLogin();

// load all admins
$user = new User();
$admins = $user->getAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>admins</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <header>
    <h1>Admins</h1>
  </header>
  <?php Utility::showNav(); ?>
  <main>
    <section>
      <h2>Admin Table</h2>
      <div class="row"></div>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Full Name</th>
            <th>City</th>
            <th>Join Date</th>
            <th>&nbsp;</th>
          </tr>
        </thead>
        <tbody>
          <!-- Show admins data -->
          <?php
          if (empty($admins)) {
            echo '<tr><td colspan="6">Belum ada data user.</td></tr>';
          }
          foreach ($admins as $admin) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($admin['id']) . '</td>';
            echo '<td>' . htmlspecialchars($admin['username']) . '</td>';
            echo '<td>' . htmlspecialchars($admin['fullname']) . '</td>';
            echo '<td>' . htmlspecialchars($admin['city']) . '</td>';
            echo '<td>' . htmlspecialchars($admin['created_at']) . '</td>';
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