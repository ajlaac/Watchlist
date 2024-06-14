<?php
class FavesDB {
    public static function addFavorite($user_id, $movie_id) {
        $db = DBInit::getInstance();
        $statement = $db->prepare("INSERT INTO Favorites (user_id, movie_id) VALUES (:user_id, :movie_id)");
        $statement->bindParam(":user_id", $user_id);
        $statement->bindParam(":movie_id", $movie_id);
        $statement->execute();
    }

    public static function removeFavorite($user_id, $movie_id) {
        $db = DBInit::getInstance();
        $statement = $db->prepare("DELETE FROM Favorites WHERE user_id = :user_id AND movie_id = :movie_id");
        $statement->bindParam(":user_id", $user_id);
        $statement->bindParam(":movie_id", $movie_id);
        $statement->execute();
    }

    public static function getUserFavorites($user_id) {
        $db = DBInit::getInstance();
        $statement = $db->prepare("SELECT movie_id FROM Favorites WHERE user_id = :user_id");
        $statement->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $statement->execute();
        $favorites = $statement->fetchAll(PDO::FETCH_COLUMN);
        return $favorites;
    }
}