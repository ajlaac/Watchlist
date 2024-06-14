<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>favestyle.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="<?= BASE_URL . "movie/movies" ?>">Movies</a></li>
                <?php if(isset($_SESSION["user_id"])): ?>
                    <li><a href="<?= BASE_URL . "watchlist" ?>">Watchlist</a></li>
                <?php endif; ?>
                <?php if(isset($_SESSION["user_id"])): ?>
                    <li><a href="<?= BASE_URL . "user/logout" ?>">Logout</a></li>
                <?php else: ?>
                    <li><a href="<?= BASE_URL . "user/register" ?>">Register</a></li>
                    <li><a href="<?= BASE_URL . "user/login" ?>">Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main>
        <h1>Welcome to Our Movie Website!</h1>
    </main>
</body>
</html>
