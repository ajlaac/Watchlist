DROP DATABASE IF EXISTS kino;
CREATE DATABASE kino;
USE kino;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE User (
    user_id INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    PRIMARY KEY (user_id)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

CREATE TABLE Movie (
    movie_id INT NOT NULL AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    genre VARCHAR(255) NOT NULL,
    director VARCHAR(255) NOT NULL,
    picture VARCHAR(255), -- Assuming picture is a URL to an image
    user_id INT NOT NULL, -- Added column for user_id
    PRIMARY KEY (movie_id),
    FOREIGN KEY (user_id) REFERENCES User(user_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

CREATE TABLE Favorites (
    movie_id INT NOT NULL,
    user_id INT NOT NULL,
    PRIMARY KEY (movie_id, user_id),
    FOREIGN KEY (movie_id) REFERENCES Movie(movie_id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES User(user_id) ON DELETE CASCADE
);

INSERT INTO User (username, password) VALUES
('ajla', '123'),
('edi', '123'),
('samir', '345');

INSERT INTO Movie (title, genre, director, picture, user_id) VALUES
('The Shawshank Redemption', 'Drama', 'Frank Darabont', 'https://example.com/shawshank.jpg', 1),
('The Godfather', 'Crime', 'Francis Ford Coppola', 'https://example.com/godfather.jpg', 1),
('The Dark Knight', 'Action', 'Christopher Nolan', 'https://example.com/darkknight.jpg', 3);

INSERT INTO Favorites (movie_id, user_id) VALUES
(1, 1), -- The Shawshank Redemption ajla
(2, 1); -- The Godfather ajla
