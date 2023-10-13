<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blog";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind the INSERT statement
$stmt = $conn->prepare("INSERT INTO comments (user_id, post_id, content) VALUES (?, ?, ?)");
$stmt->bind_param("iis", $user_id, $post_id, $content);

// Set the parameters and execute the statement
$user_id = 1; // Replace with the user ID of the logged-in user
$post_id = $_POST['post_id'];
$content = $_POST['content'];
$stmt->execute();

// Close the statement and the connection
$stmt->close();
$conn->close();

// Redirect back to the viewBlog.php page
header("Location: viewBlog.php?post_id=$post_id");
exit();
?>
