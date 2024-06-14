<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Add your CSS stylesheets here -->
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>register.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <?php if(isset($_SESSION["user_id"])): ?>
                    <li><a href="<?= BASE_URL . "user/logout" ?>">Logout</a></li>
                <?php else: ?>
                    <li><a href="<?= BASE_URL . "home" ?>">Home</a></li>
                    <li><a href="<?= BASE_URL . "movie/movies" ?>">Movies</a></li>
                    <li><a href="<?= BASE_URL . "user/register" ?>">Register</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <div class="container">
        <h1>Login</h1>
        <form action="<?php echo BASE_URL; ?>user/login" method="post">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username"><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password"><br><br>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
