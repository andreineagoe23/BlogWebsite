<?php
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

// Fetch the comments from the database and store them in the $comments array
$sql_comments = "SELECT comments.*, users.email as author FROM comments JOIN users ON comments.user_id = users.id ORDER BY comments.created_at DESC";
$result_comments = $conn->query($sql_comments);

$comments = [];

if ($result_comments->num_rows > 0) {
  // Fetch the comments and store them in the $comments array
  while($row = $result_comments->fetch_assoc()) {
    $comments[$row['post_id']][] = $row;
  }
} else {
  echo "0 results";
}
?>

<?php foreach ($posts as $post): ?>
  <div class="post">
    <h3 class="post-title"><?= htmlspecialchars($post['title']) ?></h3>
    <p class="post-content"><?= htmlspecialchars($post['content']) ?></p>
    <p class="post-date"><?= htmlspecialchars($post['created_at']) ?></p>

    <!-- Display comments -->
<div class="comments">
  <h4>Comments</h4>
  <?php if (isset($comments[$post['id']])): ?>
    <?php foreach ($comments[$post['id']] as $comment): ?>
      <div class="comment">
        <p><?= htmlspecialchars($comment['content']) ?></p>
        <p>By <?= htmlspecialchars($comment['author']) ?> on <?= htmlspecialchars($comment['created_at']) ?></p>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <p>No comments yet.</p>
  <?php endif; ?>
</div>


    <!-- Comment form -->
    <form action="addComment.php" method="POST" class="comment-form">
      <input type="hidden" name="post_id" value="<?= htmlspecialchars($post['id']) ?>">
      <label for="author">Name:</label>
      <input type="text" name="author" id="author" required>
      <label for="content">Comment:</label>
      <textarea name="content" id="content" required></textarea>
      <button type="submit">Add Comment</button>
    </form>
  </div>
<?php endforeach; ?>

<?php $conn->close(); ?>
