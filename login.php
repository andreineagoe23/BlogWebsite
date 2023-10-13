<?php
session_start();

// Your database connection details go here
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Check if the email exists
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // If the email exists, verify the hashed password
        $user = $result->fetch_assoc();
        if (password_verify($password, $user["password"])) {
            // If the password is correct, set the session variables
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["email"] = $user["email"];

            // Redirect to index.php
            header("Location: index.php");
            exit();
        } else {
            // If the password is incorrect, show an error message
            $error = "Invalid email or password.";
        }
    } else {
        // If the email does not exist, show an error message
        $error = "Invalid email or password.";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="stylelogin.css">
</head>
<body class="background-image">
<header class="header">
  <div class="logo">
    <img src="bloglogo.png" alt="My Travel Blog">
  </div>
  <div class="buttons">
    <a href="index.php">Blog</a>
    <?php if (isset($_SESSION["user_id"])) { ?>
      <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
      <form id="logout-form" method="post" action="logout.php" style="display: none;">
        <input type="hidden" name="logout">
      </form>
    <?php } else { ?>
      <a href="login.php">Login</a>
    <?php } ?>
    <a href="index.php">Home</a>
  </div>
</header>


<div class="welcome-box">
    <img src="me.jpg">
    <h2>Welcome!</h2>
</div>
<div class="form-wrapper">
    <div class="form-container">
        <form method="post" class="login-form">
            <h2>Login to My Travel Blog</h2>
            <?php if (isset($error)) { ?>
                <p class="error"><?php echo $error; ?></p>
            <?php } ?>
            <div class="form-input">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="form-input">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
    <div class="form-container signup-container">
        <form method="post" action="signup.php" class="signup-form">
                <h2>Sign Up for My Travel Blog</h2>
                <!-- Display error messages if necessary -->
                <div class="form-input">
                    <label for="signup-email">Email:</label>
                    <input type="email" name="email" id="signup-email" required>
                </div>
                <div class="form-input">
                    <label for="signup-password">Password:</label>
                    <input type="password" name="password" id="signup-password" required>
                </div>
                <button type="submit">Sign Up</button>
            </form>
        </div>
    </div>
    <footer class="footer">
        <div class="logo">
            <img src="bloglogo.png" alt="My Travel Blog">
        </div>
        <p>&copy; <?php echo date("Y"); ?> My Travel Blog. All rights reserved.</p>
        <div class="subscribe-box">
            <label>Subscribe to our newsletter:</label>
            <input type="email" placeholder="Enter your email address">
            <button type="submit">Subscribe</button>
        </div>
        <div class="social-icons">
        <div class="social-box">
            <a href="https://www.instagram.com/andreineagoe23"><img src="instagram.png" alt="Instagram"></a>
        </div>
        <div class="social-box">
            <a href="https://www.linkedin.com/in/andrei-neagoe-29a937256/"><img src="linkedin.png" alt="LinkedIn"></a>
        </div>
        <div class="social-box">
            <a href="https://www.facebook.com/andrei.neagoe.902"><img src="facebook.png" alt="Facebook"></a>
        </div>
        </div>
    </footer>
</body>
</html>
