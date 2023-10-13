<?php
session_start();

if (!isset($_GET['title']) || !isset($_GET['post'])) {
    header("Location: addEntry.php");
    exit();
}

$title = $_GET['title'];
$post = $_GET['post'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview Post</title>
    <link rel="stylesheet" href="styleEntry.css">
</head>
<body class="background-image">
    <div class="social-box">
        <a href="#" class="social-icon"><i class="fa fa-facebook"></i></a>
        <a href="#" class="social-icon"><i class="fa fa-twitter"></i></a>
        <a href="#" class="social-icon"><i class="fa fa-instagram"></i></a>
        <a href="#" class="social-icon"><i class="fa fa-pinterest"></i></a>
    </div>
    <div class="welcome-box">
        <img src="me.jpg">
        <h2>Welcome!</h2>
    </div>
    <header class="header">
        <div class="logo">
            <img src="bloglogo.png" alt="My Travel Blog">
        </div>
    </header>
    <main>
  <div class="form-wrapper">
    <div class="form-container">
      <form class="post-form" action="addPost.php" method="post">
        <h2>Preview Post</h2>
        <div class="input-wrapper">
          <label for="title">Title:</label>
          <input type="text" id="title" name="title" value="<?php echo $title; ?>" readonly>
        </div>
        <div class="input-wrapper">
          <label for="post">Post:</label>
          <textarea id="post" name="post" readonly><?php echo $post; ?></textarea>
        </div>
        <div class="buttons-wrapper">
          <button type="button" id="editBtn">Edit</button>
          <button type="submit" id="postBtn" name="postBtn">Post</button>
        </div>
      </form>
    </div>
    
    <div class="form-container">
      <form class="edit-form hidden" action="preview.php" method="get">
        <h2>Edit Post</h2>
        <div class="input-wrapper">
          <label for="title">Title:</label>
          <input type="text" id="title" name="title" value="<?php echo $title; ?>">
        </div>
        <div class="input-wrapper">
          <label for="post">Post:</label>
          <textarea id="post" name="post"><?php echo $post; ?></textarea>
        </div>
        <div class="buttons-wrapper">
          <button type="button" id="cancelBtn">Cancel</button>
          <button type="submit" id="updateBtn">Update</button>
        </div>
      </form>
    </div>
  </div>
</main>

<footer class="footer">
        <div class="logo">
            <img src="bloglogo.png" alt="My Travel Blog">
        </div>
        <p>&copy; <?php echo date("Y"); ?> My Travel Blog. All rights reserved.</p>
    </footer>

    <script>
        const editBtn = document.getElementById('editBtn');
const cancelBtn = document.getElementById('cancelBtn');
const postForm = document.querySelector('.post-form');
const editForm = document.querySelector('.edit-form');

editBtn.addEventListener('click', () => {
  postForm.classList.add('hidden');
  editForm.classList.remove('hidden');
});

cancelBtn.addEventListener('click', () => {
  postForm.classList.remove('hidden');
  editForm.classList.add('hidden');
});
    </script>
</body>
</html>
