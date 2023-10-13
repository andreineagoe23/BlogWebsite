<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Connect to the MySQL database
    $conn = mysqli_connect("localhost", "root", "", "blog");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check if the email is already registered
    $sql = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 0) {
        // Email is not registered, create a new account
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (email, password) VALUES ('$email', '$hashed_password')";

        if (mysqli_query($conn, $sql)) {
            // Account created, log in the user
            $_SESSION['email'] = $email;
            header("Location: index.php");
            exit();
        } else {
            // Error creating the account
            $error = "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        // Email is already registered
        $error = "This email is already registered.";
    }

    mysqli_close($conn);
}

// Redirect back to the login page with an error message if necessary
header("Location: login.php?error=" . urlencode($error));
exit();
