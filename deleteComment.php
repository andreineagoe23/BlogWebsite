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

// Prepare and bind the DELETE statement
$stmt = $conn->prepare("DELETE FROM comments WHERE id = ?");
$stmt->bind_param("i", $comment_id);

// Set the parameter and execute the statement
$comment_id = $_POST['comment_id'];
$stmt->execute();

// Close the statement and the connection
$stmt->close();
$conn->close();

// Redirect back to the viewBlog.php page
header("Location: viewBlog.php?post_id=$_POST[post_id]");
exit();
?>
