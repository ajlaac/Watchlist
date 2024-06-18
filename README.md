# Movie Recommendations Web Application

## Project Overview

**Application Name:** Movie Recommendations

**Developer:** Ajla Čaušević (Student ID: 63210406)

**Purpose:** The Movie Recommendations application is a web platform designed for users to share and discover movie recommendations. Users can register, log in, and add movies to the database, as well as browse movies added by others. Registered users can also create a personal watchlist by adding movies to their favorites.

## Technologies Used

- **Local Server:** XAMPP (includes Apache server and MySQL database)
- **Backend:** PHP (using the MVC model)
- **Frontend:** HTML, CSS, JavaScript
- **Database Management:** phpMyAdmin for managing MySQL database

## Application Features

### User Registration and Login

- Users can create an account by filling out a registration form with basic information.
- After successful registration, users can log in using their credentials.
- Passwords are hashed for security.

### Anonymous and Registered Users

- **Anonymous Users:** Can browse and search for movies.
- **Registered Users:** Can add movies to the database, create a personal watchlist (favorites), and delete movies they have added.

### Database Structure

![image](https://github.com/ajlaac/Watchlist/assets/141041671/b51388d4-eaca-4da2-aa7d-1c808f98ee7c)


The application uses a MySQL database with the following tables:

- **users**
  - `user_id` (Primary Key)
  - `username`
  - `password` (hashed)

- **movies**
  - `movie_id` (Primary Key)
  - `title`
  - `genre`
  - `director`
  - `picture` (stored as a URL)
  - `user_id` (Foreign Key, links to `users` table)

- **favorites**
  - `movie_id` (Foreign Key, links to `movies` table)
  - `user_id` (Foreign Key, links to `users` table)
  - Primary Key (`movie_id`, `user_id`)

### Sitemap

![image](https://github.com/ajlaac/Watchlist/assets/141041671/0655c875-b48c-4016-97c8-ee41ddeb7b3b)


### HTTP Request Handling

The application adheres to HTTP standards for request handling:

- **GET:** Used for retrieving pages and data (e.g., browsing movies, viewing movie details).
- **POST:** Used for submitting data (e.g., registration, login, adding a movie).
- **DELETE:** Used for removing movies from the user's recommendations or watchlist.

## Installation and Setup

1. **Set Up Local Server:**
   - Download and install XAMPP from [https://www.apachefriends.org/index.html](https://www.apachefriends.org/index.html).
   - Start Apache and MySQL from the XAMPP control panel.

2. **Clone Repository:**
   - Clone the project repository to your local machine.

3. **Database Configuration:**
   - Open phpMyAdmin at [http://localhost/phpmyadmin](http://localhost/phpmyadmin).
   - Create a new database named `movie_recommendations`.
   - Import the provided SQL file to create the necessary tables and relationships.

4. **Configure Application:**
   - Update database connection settings in the PHP configuration file (e.g., `config.php`).

5. **Run Application:**
   - Navigate to the project directory in your browser (e.g., [http://localhost/movies](http://localhost/movies)).
   - Register a new user or log in with existing credentials to start using the application.

## Usage

- **Browsing Movies:** Accessible to all users. Use the search bar to find specific movies.
- **Adding Movies:** Requires user to be logged in. Fill out the add movie form with necessary details.
- **Creating Watchlist:** Logged-in users can add movies to their watchlist from the movie details page.
- **Managing Recommendations:** Logged-in users can delete movies they have added from their account settings.

This README file provides a comprehensive guide to understanding, setting up, and using the Movie Recommendations web application.
