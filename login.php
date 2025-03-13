<?php
session_start();
include "config.php"; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Check if user exists
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        // Verify password
        if (password_verify($password, $user["password"])) {
            $_SESSION["user"] = $user["email"];
            header("Location: sidebar-menu/index.php"); // Redirect to dashboard
            exit();
        } else {
            $_SESSION["error"] = "Invalid password.";
            header("Location: index.php"); // Redirect back to login
            exit();
        }
    } else {
        $_SESSION["error"] = "User not found.";
        header("Location: index.php"); // Redirect back to login
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
