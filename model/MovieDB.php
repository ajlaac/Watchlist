<?php

require_once "DBInit.php";

class MovieDB {

    public static function addMovie($title, $genre, $director, $picture, $user_id) {
        $db = DBInit::getInstance();
        $statement = $db->prepare("INSERT INTO Movie (title, genre, director, picture, user_id) VALUES (:title, :genre, :director, :picture, :user_id)");
        $statement->bindParam(":title", $title);
        $statement->bindParam(":genre", $genre);
        $statement->bindParam(":director", $director);
        $statement->bindParam(":picture", $picture);
        $statement->bindParam(":user_id", $user_id);
        $statement->execute();
    } 

    public static function deleteMovie($movie_id) {
        $db = DBInit::getInstance();
        $statement = $db->prepare("DELETE FROM Movie WHERE movie_id = :movie_id");
        $statement->bindParam(":movie_id", $movie_id);
        $statement->execute();
    }

    public static function isUserMovie($movie_id, $user_id) {
        $db = DBInit::getInstance();
        $statement = $db->prepare("SELECT COUNT(*) FROM Movie WHERE movie_id = :movie_id AND user_id = :user_id");
        $statement->bindParam(":movie_id", $movie_id);
        $statement->bindParam(":user_id", $user_id);
        $statement->execute();
        $count = $statement->fetchColumn();
        return $count > 0;
    }
    
    public static function getAllMovies() {
        $db = DBInit::getInstance();
        $statement = $db->prepare("SELECT * FROM Movie");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getMoviesByIds($movieIds) {
        if (empty($movieIds)) {
            return [];
        }
        $db = DBInit::getInstance();
        $in  = str_repeat('?,', count($movieIds) - 1) . '?';
        $sql = "SELECT * FROM Movie WHERE movie_id IN ($in)";
        $statement = $db->prepare($sql);
        $statement->execute($movieIds);
        return $statement->fetchAll();
    }

    public static function searchMovies($query) {
        try {
            $db = DBInit::getInstance(); // Get a database connection instance

            // Prepare the SQL query to search for movies
            $stmt = $db->prepare("SELECT * FROM movie WHERE title LIKE :query");

            // Bind the search query parameter
            $stmt->bindValue(':query', '%' . $query . '%', PDO::PARAM_STR);

            // Execute the query
            $stmt->execute();

            // Fetch all matching movies as an associative array
            $searchResults = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $searchResults;
        } catch (PDOException $e) {
            // Handle database errors appropriately (e.g., log the error, display an error message)
            // Example: Log the error and return an empty array
            error_log("Error searching movies: " . $e->getMessage());
            return [];
        }
    }

    public static function searchMoviesByTitle($title) {
        $db = DBInit::getInstance();
        $statement = $db->prepare("SELECT * FROM movie WHERE title LIKE :title");
        $statement->bindValue(":title", '%' . $title . '%');
        $statement->execute();
        return $statement->fetchAll();
    }

}
