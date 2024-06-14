<?php
require_once("ViewHelper.php");
require_once("model/FavesDB.php");
require_once("model/MovieDB.php");

class FavesController {
    public static function add() {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["movie_id"]) && isset($_POST["is_favorite"])) {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $user_id = $_SESSION["user_id"];
            $movie_id = $_POST["movie_id"];
            $is_favorite = $_POST["is_favorite"];
            
            // Perform the necessary operations to add/remove the movie from favorites for the logged-in user
            if ($is_favorite == "1") {
                FavesDB::addFavorite($user_id, $movie_id);
            } else {
                FavesDB::removeFavorite($user_id, $movie_id);
            }
            ViewHelper::redirect(BASE_URL . "movie/movies");

        } else {
            ViewHelper::redirect(BASE_URL . "movie/movies");
        }
    }

    public static function get() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        // Check if the user is logged in
        if (!isset($_SESSION["user_id"])) {
            // Return an error response or redirect to the login page
            // For example:
            http_response_code(403); // Forbidden
            echo "User is not logged in";
            exit();
        }

        // Fetch user's favorite movies from the database
        $user_id = $_SESSION["user_id"];
        $favorites = FavesDB::getUserFavorites($user_id);

        // Fetch details of favorite movies
        $favoriteMovies = MovieDB::getMoviesByIds($favorites);

        // Render the favorites view with the retrieved movies
        ViewHelper::render("view/faves.php", ["favoriteMovies" => $favoriteMovies]);
    }
}
?>
