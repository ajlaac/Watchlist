<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies</title>
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>moviestyle.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="<?= BASE_URL . "home" ?>">Home</a></li>
                <?php if(isset($_SESSION["user_id"])): ?>
                    <li><a href="<?= BASE_URL . "watchlist" ?>">Watchlist</a></li>
                    <li><a href="<?= BASE_URL . "movie/add" ?>">Add Movie</a></li>
                    <li><a href="<?= BASE_URL . "user/logout" ?>">Logout</a></li>
                <?php else: ?>
                    <li><a href="<?= BASE_URL . "user/register" ?>">Register</a></li>
                    <li><a href="<?= BASE_URL . "user/login" ?>">Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main>
        <!-- Search Form -->
        <form method="get" action="" class="search-form">
            <input type="text" name="search" placeholder="Search by title" value="<?= htmlspecialchars($searchQuery ?? '', ENT_QUOTES) ?>">
            <input type="submit" value="Search" class="search-button">
        </form>

        <!-- Display Search Results -->
        <?php if (isset($searchResults) && !empty($searchResults)): ?>
            <h2>Search Results</h2>
            <div class="search-results">
                <?php foreach ($searchResults as $movie): ?>
                    <div class="movie">
                        <h2><?php echo $movie["title"]; ?></h2>
                        <p><strong>Genre:</strong> <?php echo $movie["genre"]; ?></p>
                        <p><strong>Director:</strong> <?php echo $movie["director"]; ?></p>
                        <img src="<?php echo $movie["picture"]; ?>" alt="<?php echo $movie["title"]; ?>" class="movie-img">
                        
                        <!-- Add/Remove from Watchlist -->
                        <?php if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] == $movie["user_id"]): ?>
                            <form action="<?php echo BASE_URL; ?>movie/delete" method="post" onsubmit="return confirmDelete();">
                                <input type="hidden" name="movie_id" value="<?php echo $movie['movie_id']; ?>">
                                <input type="submit" value="Delete">
                            </form>
                        <?php endif; ?>
                        
                        <?php if (isset($_SESSION["user_id"]) && in_array($movie["movie_id"], $favoriteMovieIds)): ?>
                            <form action="<?php echo BASE_URL; ?>favorites/add" method="post">
                                <input type="hidden" name="movie_id" value="<?php echo $movie["movie_id"]; ?>">
                                <input type="hidden" name="is_favorite" value="0">
                                <input type="submit" value="Remove from Watchlist">
                            </form>
                        <?php elseif (isset($_SESSION["user_id"])): ?>
                            <form action="<?php echo BASE_URL; ?>favorites/add" method="post">
                                <input type="hidden" name="movie_id" value="<?php echo $movie["movie_id"]; ?>">
                                <input type="hidden" name="is_favorite" value="1">
                                <input type="submit" value="Add to Watchlist">
                            </form>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="nothing">Nothing found.</p>
        <?php endif; ?>

        
        <h2>All Movies</h2>

        <!-- Display All Movies -->
        <div class="movies-container">
            <?php foreach ($movies as $movie): ?>
                <div class="movie">
                    <h2><?php echo $movie["title"]; ?></h2>
                    <p><strong>Genre:</strong> <?php echo $movie["genre"]; ?></p>
                    <p><strong>Director:</strong> <?php echo $movie["director"]; ?></p>
                    <img src="<?php echo $movie["picture"]; ?>" alt="<?php echo $movie["title"]; ?>" class="movie-img">
                    
                    <!-- Add/Remove from Watchlist -->
                    <?php if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] == $movie["user_id"]): ?>
                        <form action="<?php echo BASE_URL; ?>movie/delete" method="post" onsubmit="return confirmDelete();">
                            <input type="hidden" name="movie_id" value="<?php echo $movie['movie_id']; ?>">
                            <input type="submit" value="Delete">
                        </form>
                    <?php endif; ?>
                    
                    <?php if (isset($_SESSION["user_id"]) && in_array($movie["movie_id"], $favoriteMovieIds)): ?>
                        <form action="<?php echo BASE_URL; ?>favorites/add" method="post">
                            <input type="hidden" name="movie_id" value="<?php echo $movie["movie_id"]; ?>">
                            <input type="hidden" name="is_favorite" value="0">
                            <input type="submit" value="Remove from Watchlist">
                        </form>
                    <?php elseif (isset($_SESSION["user_id"])): ?>
                        <form action="<?php echo BASE_URL; ?>favorites/add" method="post">
                            <input type="hidden" name="movie_id" value="<?php echo $movie["movie_id"]; ?>">
                            <input type="hidden" name="is_favorite" value="1">
                            <input type="submit" value="Add to Watchlist">
                        </form>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this movie?');
        }
    </script>
</body>
</html>
