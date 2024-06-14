<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Movie</title>
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>addstyle.css">
</head>
<body>
    <!-- Navigation Menu -->
    <header>
        <nav>
            <ul>
                <li><a href="<?php echo BASE_URL; ?>">Home</a></li>
                <li><a href="<?php echo BASE_URL; ?>movie/movies">Movies</a></li>
                <li><a href="<?php echo BASE_URL; ?>watchlist">Watchlist</a></li>
                <li><a href="<?php echo BASE_URL; ?>user/logout">Logout</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <h1>Add Movie</h1>

        <form action="<?php echo BASE_URL; ?>movie/add" method="post" id="add-movie-form">
            <!-- Title input -->
            <label for="title">Title:</label><br>
            <input type="text" id="title" name="title" value="<?php echo isset($title) ? htmlspecialchars($title) : ''; ?>"><br>

            <!-- Genre select -->
            <label for="genre">Genre:</label><br>
            <select id="genre" name="genre">
                <option value="Action" <?php echo isset($genre) && $genre === 'Action' ? 'selected' : ''; ?>>Action</option>
                <option value="Comedy" <?php echo isset($genre) && $genre === 'Comedy' ? 'selected' : ''; ?>>Comedy</option>
                <option value="Drama" <?php echo isset($genre) && $genre === 'Drama' ? 'selected' : ''; ?>>Drama</option>
                <option value="Adventure" <?php echo isset($genre) && $genre === 'Adventure' ? 'selected' : ''; ?>>Adventure</option>
                <option value="Animation" <?php echo isset($genre) && $genre === 'Animation' ? 'selected' : ''; ?>>Animation</option>
                <option value="Biography" <?php echo isset($genre) && $genre === 'Biography' ? 'selected' : ''; ?>>Biography</option>
                <option value="Crime" <?php echo isset($genre) && $genre === 'Crime' ? 'selected' : ''; ?>>Crime</option>
                <option value="Documentary" <?php echo isset($genre) && $genre === 'Documentary' ? 'selected' : ''; ?>>Documentary</option>
                <option value="Family" <?php echo isset($genre) && $genre === 'Family' ? 'selected' : ''; ?>>Family</option>
                <option value="Fantasy" <?php echo isset($genre) && $genre === 'Fantasy' ? 'selected' : ''; ?>>Fantasy</option>
                <option value="Horror" <?php echo isset($genre) && $genre === 'Horror' ? 'selected' : ''; ?>>Horror</option>
                <option value="Musical" <?php echo isset($genre) && $genre === 'Musical' ? 'selected' : ''; ?>>Musical</option>
                <option value="Mystery" <?php echo isset($genre) && $genre === 'Mystery' ? 'selected' : ''; ?>>Mystery</option>
                <option value="Romance" <?php echo isset($genre) && $genre === 'Romance' ? 'selected' : ''; ?>>Romance</option>
                <option value="Sci-Fi" <?php echo isset($genre) && $genre === 'Sci-Fi' ? 'selected' : ''; ?>>Sci-Fi</option>
                <option value="Thriller" <?php echo isset($genre) && $genre === 'Thriller' ? 'selected' : ''; ?>>Thriller</option>
                <option value="War" <?php echo isset($genre) && $genre === 'War' ? 'selected' : ''; ?>>War</option>
                <option value="Western" <?php echo isset($genre) && $genre === 'Western' ? 'selected' : ''; ?>>Western</option>
                <!-- Add more options as needed -->
            </select><br>

            <!-- Director input -->
            <label for="director">Director:</label><br>
            <input type="text" id="director" name="director" value="<?php echo isset($director) ? htmlspecialchars($director) : ''; ?>"><br>

            <!-- Picture input -->
            <label for="picture">Picture (URL):</label><br>
            <input type="text" id="picture" name="picture" value="<?php echo isset($picture) ? htmlspecialchars($picture) : ''; ?>"><br><br>

            <!-- Submit button -->
            <button type="button" onclick="validateForm()">Add Movie</button>
        </form>
    </div>

    <script>
        function validateForm() {
            var title = document.getElementById('title').value;
            var genre = document.getElementById('genre').value;
            var director = document.getElementById('director').value;
            var picture = document.getElementById('picture').value;

            // Array to store errors
            var errors = [];

            // Form validation
            if (!title.trim()) {
                errors.push("Title is required.");
            }
            if (!genre.trim()) {
                errors.push("Genre is required.");
            }
            if (!director.trim()) {
                errors.push("Director's name is required.");
            } else {
                // Regex pattern for a name containing alphabets and spaces
                var directorPattern = /^[a-zA-Z]+(?: [a-zA-Z]+)*$/;
                if (!directorPattern.test(director.trim())) {
                    errors.push("Invalid director's name.");
                }
            }
            if (!picture.trim()) {
                errors.push("Picture (URL) is required.");
            } else {
                // Regex pattern for URL validation
                var urlPattern = /^(ftp|http|https):\/\/[^ "]+$/;
                if (!urlPattern.test(picture.trim())) {
                    errors.push("Invalid picture URL.");
                }
            }

            // Display alerts if there are errors
            if (errors.length > 0) {
                alert("Error(s) occurred:\n" + errors.join("\n"));
                return; // Prevent form submission
            }

            // Submit the form if there are no errors
            document.getElementById('add-movie-form').submit();
        }
    </script>
</body>
</html>
