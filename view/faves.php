<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorites</title>
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>favestyle.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="<?= BASE_URL . "home" ?>">Home</a></li>
                <?php if(isset($_SESSION["user_id"])): ?>
                    <li><a href="<?= BASE_URL . "movie/movies" ?>">Movies</a></li>
                    <li><a href="<?= BASE_URL . "movie/add" ?>">Add Movie</a></li>
                    <li><a href="<?= BASE_URL . "user/logout" ?>">Logout</a></li>
                <?php else: ?>
                    <li><a href="<?= BASE_URL . "user/register" ?>">Register</a></li>
                    <li><a href="<?= BASE_URL . "user/login" ?>">Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <h1>Watchlist</h1>
    <?php if (empty($favoriteMovies)): ?>
        <p>You have no favorite movies.</p>
    <?php else: ?>
        <?php foreach ($favoriteMovies as $movie): ?>
            <div class="movie">
                <h2><?php echo $movie["title"]; ?></h2>
                <p><strong>Genre:</strong> <?php echo $movie["genre"]; ?></p>
                <p><strong>Director:</strong> <?php echo $movie["director"]; ?></p>
                <img src="<?php echo $movie["picture"]; ?>" alt="<?php echo $movie["title"]; ?>" class="movie-img">

                <!-- Remove from Watchlist -->
                <form action="<?php echo BASE_URL; ?>favorites/add" method="post">
                    <input type="hidden" name="movie_id" value="<?php echo $movie["movie_id"]; ?>">
                    <input type="hidden" name="is_favorite" value="0">
                    <input type="submit" value="Remove from Watchlist">
                </form>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

</body>
</html>
