<?php

require_once("controller/MovieController.php");
require_once("controller/FavesController.php");
require_once("controller/UserController.php");

define("BASE_URL", $_SERVER["SCRIPT_NAME"] . "/");
define("IMAGES_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "static/images/");
define("CSS_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "static/css/");

// Check if session is not active before starting it
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$path = isset($_SERVER["PATH_INFO"]) ? trim($_SERVER["PATH_INFO"], "/") : "";

$urls = [
    "home" => function () {
       UserController::index();
    },
    
    "user/register" => function () {
        if(isset($_SESSION["user_id"])) {
            header("Location: " . BASE_URL . "home");
            exit();
        } else {
            // If the user is not logged in, proceed to register
            UserController::register();
        }
    },
    "user/login" => function () {
        UserController::login();
    },
    "movie/movies" => function () {
        $controller = new MovieController();
        $controller->index();
    },
    "user/logout" => function () {
        UserController::logout();
    },
    "movie/add" => function () {
        // Check if user is logged in before allowing access
        if (isset($_SESSION["user_id"])) {
            MovieController::add();
        } else {
            // Redirect user to login page
            header("Location: " . BASE_URL . "user/login");
            exit();
        }
    },
    "movie/delete" => function () {
        if (isset($_SESSION["user_id"])) {
            MovieController::delete();
            header("Location: " . BASE_URL . "movie/movies");
            exit();

        } else {
            // Redirect user to login page
            header("Location: " . BASE_URL . "user/login");
            exit();
        }
    },
    "error" => function () {
        header("Location: " . BASE_URL . "home");
            exit();
    },
    "search" => function () {
        MovieController::search();
    },
    "favorites/add" => function () {
        FavesController::add();
    },
    "watchlist" => function () {
        FavesController::get();
    },
    "" => function () {
        // Redirect to home page if no route matches
        header("Location: " . BASE_URL . "home");
        exit();
    },
];

try {
    if (isset($urls[$path])) {
       $urls[$path]();
    } else {
        echo "No controller for '$path'";
    }
} catch (Exception $e) {
    echo "An error occurred: <pre>$e</pre>";
    // ViewHelper::error404();
}
?>
