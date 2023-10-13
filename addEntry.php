<?php
session_start();

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $post = $_POST['post'];

    // Check which button was clicked
    if (isset($_POST['previewBtn'])) {
        // Preview button was clicked, save the form data to the session
        $_SESSION['preview_title'] = $title;
        $_SESSION['preview_post'] = $post;

        // Redirect to the preview page
        header("Location: preview.php");
        exit();
    } else if (isset($_POST['postBtn'])) {
        // Post button was clicked, insert the post into the database
        $created_at = date('Y-m-d H:i:s');
        $conn = mysqli_connect("localhost", "root", "", "blog");
        $sql = "INSERT INTO posts (title, content, created_at) VALUES ('$title', '$post', '$created_at')";
        if (mysqli_query($conn, $sql)) {
            // Post added successfully, redirect to the index page
            header("Location: index.php");
            exit();
        } else {
            // Error adding the post
            $error = "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
}

// Check if there is any saved preview data in the session
$preview_title = isset($_SESSION['preview_title']) ? $_SESSION['preview_title'] : '';
$preview_post = isset($_SESSION['preview_post']) ? $_SESSION['preview_post'] : '';
unset($_SESSION['preview_title']);
unset($_SESSION['preview_post']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Entry</title>
    <link rel="stylesheet" href="styleEntry.css">
</head>
<body class="background-image">
    <div class="welcome-box">
        <img src="me.jpg">
        <h2>Welcome!</h2>
    </div>
    <div class="header">
        <div class="logo">
            <img src="bloglogo.png" alt="My Travel Blog">
        </div>
    </div>
    <div class="form-wrapper">
        <div class="form-container">
            <h2>Add a New Blog Post</h2>
            <form id="addPostForm" action="addPost.php" method="post">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required>
                <br>
                <label for="post">Post:</label>
                <textarea id="post" name="post" required></textarea>
                <br>
                <button type="submit" id="previewBtn" name="previewBtn">Preview</button>
                <button type="submit" id="postBtn" name="postBtn">Post</button>
                <button type="button" id="clearBtn" name="clearBtn">Clear</button>

            </form>
        </div>
    </div>
    <footer class="footer">
        <p>&copy; <?php echo date("Y"); ?> My Travel Blog. All rights reserved.</p>
        <p>
            <a href="#">Terms of Service</a> | <a href="#">Privacy Policy</a> | <a href="#">Contact Us</a>
        </p>
        
    </footer>
</body>
</html>
