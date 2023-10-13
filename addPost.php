<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $post = $_POST['post'];
    $created_at = date('Y-m-d H:i:s');

    // Check if the Preview button was clicked
    if (isset($_POST['previewBtn'])) {
        // Redirect to preview.php with the post details
        header("Location: preview.php?title=" . urlencode($title) . "&post=" . urlencode($post));
        exit();
    } else if (isset($_POST['postBtn'])) {
        // Connect to the MySQL database
        $conn = mysqli_connect("localhost", "root", "", "blog");

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Insert the post into the database
        $sql = "INSERT INTO posts (title, content, created_at) VALUES ('$title', '$post', '$created_at')";

        if (mysqli_query($conn, $sql)) {
            // Post added successfully, redirect to index.php
            header("Location: index.php");
            exit();
        } else {
            // Error adding the post
            $error = "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);
    }
}

// Redirect back to the addEntry page with an error message if necessary
header("Location: addEntry.php?error=" . urlencode($error));
exit();
?>
