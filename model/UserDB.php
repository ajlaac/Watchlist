<?php

require_once "DBInit.php";

class UserDB {

    public static function getUserByUsername($username) {
        $db = DBInit::getInstance();
        $statement = $db->prepare("SELECT user_id, password FROM User WHERE username = :username");
        $statement->bindParam(":username", $username);
        $statement->execute();
        return $statement->fetch();
    }

}