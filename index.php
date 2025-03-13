<?php
include "config.php";

// Function to create the super admin if it doesn't exist
function createSuperAdmin($conn) {
    $email = "superadmin@gmail.com";
    $password = "superadmin123";
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Check if super admin already exists
    $checkQuery = "SELECT id FROM users WHERE email = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 0) {
        // Insert super admin
        $stmt->close();
        $insertQuery = "INSERT INTO users (email, password) VALUES (?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("ss", $email, $hashedPassword);
        $stmt->execute();
    }

    $stmt->close();
}

// Run the function to ensure super admin exists
createSuperAdmin($conn);

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="../style/login.css">
  <link rel="icon" href="/asset/favicon.ico" type="image/x-icon">
  <script type="text/javascript" src="validation.js" defer></script>
</head>
<body>
  <div class="wrapper">
    <h1>Login</h1>
    <p id="error-message"></p>
    <form id="form" action="login.php" method="POST">
      <div>
        <label for="email-input">
          <span>@</span>
        </label>
        <input type="email" name="email" id="email-input" placeholder="Email" required>
      </div>
      <div>
        <label for="password-input">
          <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M240-80q-33 0-56.5-23.5T160-160v-400q0-33 23.5-56.5T240-640h40v-80q0-83 58.5-141.5T480-920q83 0 141.5 58.5T680-720v80h40q33 0 56.5 23.5T800-560v400q0 33-23.5 56.5T720-80H240Zm240-200q33 0 56.5-23.5T560-360q0-33-23.5-56.5T480-440q-33 0-56.5 23.5T400-360q0 33 23.5 56.5T480-280ZM360-640h240v-80q0-50-35-85t-85-35q-50 0-85 35t-35 85v80Z"/></svg>
        </label>
        <input type="password" name="password" id="password-input" placeholder="Password" required>
      </div>
      <button type="submit">Login</button>
    </form>
  </div>
</body>
</html>
