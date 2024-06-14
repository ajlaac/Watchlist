<?php

require_once("model/UserDB.php");
require_once("ViewHelper.php");
session_start();

class UserController {

    public static function index() {
        // Load the home.php view directly
        ViewHelper::render("view/home.php");
    }

    public static function register() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve username and password from the registration form
            $username = $_POST["username"];
            $password = $_POST["password"];

            // Hash the password for security
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Add the new user to the database
            try {
                $db = DBInit::getInstance();
                $statement = $db->prepare("INSERT INTO User (username, password) VALUES (:username, :password)");
                $statement->bindParam(":username", $username);
                $statement->bindParam(":password", $hashedPassword);
                $statement->execute();
                
                // Redirect to the home page or any other page after successful registration
                ViewHelper::redirect(BASE_URL . "user/login");
            } catch (PDOException $e) {
                // Handle database errors
                echo "Error: " . $e->getMessage();
            }
        } else {
            // If the request method is not POST, render the registration form
            ViewHelper::render("view/user-register-form.php");
        }
    }

    public static function login() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve username and password from the login form
            $username = $_POST["username"];
            $password = $_POST["password"];

            // Check if the user exists and the password is correct
            try {
                $db = DBInit::getInstance();
                $statement = $db->prepare("SELECT user_id, password FROM User WHERE username = :username");
                $statement->bindParam(":username", $username);
                $statement->execute();
                
                $user = $statement->fetch();

                // Verify password if user exists
                if ($user && password_verify($password, $user["password"])) {
                    // Start session and set user_id session variable
                    session_start();
                    $_SESSION["user_id"] = $user["user_id"];
                    
                    // Redirect to the movies page
                    ViewHelper::redirect(BASE_URL . "movie/movies");
                } else {
                    // Redirect to the registration page if user does not exist or password is incorrect
                    ViewHelper::redirect(BASE_URL . "user/register");
                }
            } catch (PDOException $e) {
                // Handle database errors
                echo "Error: " . $e->getMessage();
            }
        } else {
            // If the request method is not POST, render the login form
            ViewHelper::render("view/user-login-form.php");
        }
    }

    public static function logout() {
        // Start the session
        session_start();

        // Unset all session variables
        $_SESSION = array();

        // Destroy the session
        session_destroy();

        // Redirect to the home page or any other page after logout
        ViewHelper::redirect(BASE_URL . "");
    }
    

}