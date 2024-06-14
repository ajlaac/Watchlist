<?php

require_once("ViewHelper.php");
require_once("model/MovieDB.php");
require_once("model/FavesDB.php");

class MovieController {

    public static function startSessionIfNeeded() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function index() {
        self::startSessionIfNeeded();
        $searchQuery = isset($_GET['search']) ? $_GET['search'] : null;
        $movies = MovieDB::getAllMovies();
        $favoriteMovieIds = isset($_SESSION["user_id"]) ? FavesDB::getUserFavorites($_SESSION["user_id"]) : [];

        if ($searchQuery) {
            $searchResults = MovieDB::searchMoviesByTitle($searchQuery);
        }

        require_once 'view/movies.php';
    }

    public static function add() {
        self::startSessionIfNeeded(); // Ensure session is started

        // Handle adding a movie
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $title = $_POST["title"];
            $genre = $_POST["genre"];
            $director = $_POST["director"];
            $picture = $_POST["picture"]; // Assuming the picture is a URL
            $user_id = $_SESSION["user_id"]; // Assuming user is logged in and user_id is stored in session

            // Add the movie to the database
            MovieDB::addMovie($title, $genre, $director, $picture, $user_id);

            // Redirect to the movies page after adding the movie
            ViewHelper::redirect(BASE_URL . "movie/movies");
        } else {
            // Render the add movie form
            ViewHelper::render("view/add_movie.php");
        }
    }

    public static function handleSearchResults() {
        // Check if a search query is submitted
        if (isset($_GET['query'])) {
            // Retrieve search results from the database based on the query
            return MovieDB::searchMovies($_GET['query']);
        } else {
            // If no search query is submitted, initialize searchResults as an empty array
            return [];
        }
    }
    

    public static function delete() {
        self::startSessionIfNeeded(); // Ensure session is started

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["movie_id"])) {
            $movie_id = $_POST["movie_id"];
            $user_id = $_SESSION["user_id"];

            // Check if the user has permission to delete the movie
            if (MovieDB::isUserMovie($movie_id, $user_id)) {
                MovieDB::deleteMovie($movie_id);
                ViewHelper::redirect(BASE_URL . "movie/movies");
            } else {
                // Redirect user to unauthorized page
                ViewHelper::redirect(BASE_URL . "home");
            }
        } else {
            // Redirect user to error page
            ViewHelper::redirect(BASE_URL . "home");
        }
    }

    public static function search() {
        self::startSessionIfNeeded();
        // Check if a search query is submitted
        if (isset($_GET['query'])) {
            // Retrieve search results from the database based on the query
            $searchResults = MovieDB::searchMovies($_GET['query']);
        } else {
            // If no search query is submitted, retrieve all movies from the database
            $searchResults = [];
        }
    
        // Retrieve all movies from the database
        $movies = MovieDB::getAllMovies();
    
        // Retrieve user's favorite movie IDs if the user is logged in
        $favoriteMovieIds = isset($_SESSION["user_id"]) ? FavesDB::getUserFavorites($_SESSION["user_id"]) : [];
    
        // Render the search results view or index view with the retrieved movies and search results
        ViewHelper::render("view/movies.php", [
            "movies" => $movies,
            "searchResults" => $searchResults,
            "favoriteMovieIds" => $favoriteMovieIds
        ]);
    }
    
    

}
?>
