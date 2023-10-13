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

// Fetch the recent posts from the database and store them in the $posts array
$sql_posts = "SELECT * FROM posts ORDER BY created_at DESC LIMIT 2";
$result_posts = $conn->query($sql_posts);

$posts = [];

if ($result_posts->num_rows > 0) {
  // Fetch the posts and store them in the $posts array
  while($row = $result_posts->fetch_assoc()) {
    $posts[] = $row;
  }
} else {
  echo "0 results";
}

// Close the database connection
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Travel Blog</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="header">
        <div class="logo">
            <img src="bloglogo.png" alt="My Travel Blog Logo">
        </div>
        <div class="search">
            <form action="#" method="get">
                <input type="text" placeholder="Search...">
                <button type="submit">Search</button>
            </form>
        </div>
        <nav class="buttons">
            <a href="http://localhost/index.php">Home</a>
            <a href="http://localhost/login.php">Login</a>
            <a href="http://localhost/logout.php">Logout</a>
        </nav>
    </header>
    <div class="video-background">
        <video src="backgroundlogin.jpg" autoplay loop muted></video>
        <div class="main-content">
        <div class="add-post-section">
          <a href="http://localhost/addEntry.php">Add Post</a>
        </div>
        
        <section class="recent-posts">
  <h2>Recent Posts</h2>
  <?php $i = 0; ?>
  <?php while($i < count($posts)): ?>
    <div class="post">
      <h3 class="post-title"><?= htmlspecialchars($posts[$i]['title']) ?></h3>
      <p class="post-content"><?= htmlspecialchars($posts[$i]['content']) ?></p>
      <p class="post-date"><?= htmlspecialchars($posts[$i]['created_at']) ?></p>
      <a href="viewBlog.php?id=<?= htmlspecialchars($posts[$i]['id']) ?>">View more</a>
    </div>
    <?php $i++; ?>
  <?php endwhile; ?>
  <?php if ($i < count($posts)): ?>
    <button id="view-more">View more</button>
  <?php endif; ?>
</section>


      </div>
    </div>
    <div class="welcome-box">
        <img src="me.jpg" alt="Profile Picture">
        <p>Welcome!</p>
    </div>

    <aside class="social-icons">
        <div class="social-box">
            <a href="https://www.instagram.com/andreineagoe23"><img src="instagram.png" alt="Instagram"></a>
        </div>
        <div class="social-box">
            <a href="https://www.linkedin.com/in/andrei-neagoe-29a937256/"><img src="linkedin.png" alt="LinkedIn"></a>
        </div>
        <div class="social-box">
            <a href="https://www.facebook.com/andrei.neagoe.902"><img src="facebook.png" alt="Facebook"></a>
        </div>
    </aside>

    <footer class="footer">
        <div class="logo">
            <img src="bloglogo.png" alt="My Travel Blog Logo">
        </div>
        <div class="subscribe-box">
            <form action="#" method="post">
                <input type="email" placeholder="Enter your email address...">
                <button type="submit">Subscribe</button>
            </form>
            <p>Subscribe for more travel info!</p>
        </div>
    </footer>
    <script src="script1.js"></script>
</body>
</html>