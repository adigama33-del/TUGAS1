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
            <form action="saveProduct.php" method="post" id="form-product">
                <div class="row"></div>
                <div class="row">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="" required>
                </div>
                <div class="row">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                </div>
                <div class="row">
                <label for="confirm">Confirm:</label>
                <input type="password" id="confirm" name="confirm" required>
                </div>
                <hr>
                <div class="row">
                <label for="fullname">Full Name:</label> 
                <input type="text" id="fullname" name="fullname" value="" required>
                </div>
                <div class="row">
                <label for="city">City:</label>
                <input type="text" id="city" name="city" value="" required>
                </div>
                <hr>
                <div class="row"><?php Utility::showFlash(); ?></div>
                <div class="row">
                <button type="submit">Daftar</button>
                </div>
            </form>
        </section>
    </main>
</body>
</html>