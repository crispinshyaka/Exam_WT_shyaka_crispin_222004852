<?php
require_once 'database.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Check if user exists in the database
    $sql = "SELECT * FROM users WHERE username = ? AND role = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $role);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Directly compare the password (Not recommended for production)
        if ($password == $user['password']) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // Redirect based on role
            if ($role == 'consultant') {
                header("Location: home1.php");
            } else {
                header("Location: home.php");
            }
            exit();
        } else {
            echo "Error: Incorrect password.";
        }
    } else {
        echo "Error: No user found with the specified role.";
    }

    $stmt->close();
    $conn->close();
}
?>
