<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>register.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="<?= BASE_URL . "home" ?>">Home</a></li>
                <li><a href="<?= BASE_URL . "movie/movies" ?>">Movies</a></li>
                <li><a href="<?= BASE_URL . "user/login" ?>">Login</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <h1>Register</h1>
        <form action="<?php echo BASE_URL; ?>user/register" method="post">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username"><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password"><br><br>
            <button type="submit">Create Account</button>
        </form>
    </div>
</body>
</html>

