<?php
require_once 'database.php';
session_start();

// Retrieve form data
$full_name = $_POST['full_name'];
$email = $_POST['email'];
$diet = $_POST['diet'];
$address = $_POST['address'];
$username = $_POST['username'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// Validate that passwords match
if ($password !== $confirm_password) {
    echo "Error: Passwords do not match.";
    exit(); // Exit the script if passwords do not match
}

// Check if user already exists
$sql_check = "SELECT * FROM users WHERE username = ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("s", $username);
$stmt_check->execute();
$result_check = $stmt_check->get_result();

if ($result_check->num_rows > 0) {
    echo "Error: User already exists.";
    $stmt_check->close();
    $conn->close();
    exit(); // Exit the script if user already exists
}
$stmt_check->close();

// Begin a transaction
$conn->begin_transaction();

try {
    // Insert data into clients table
    $sql_clients = "INSERT INTO clients (full_name, email, diet, address) VALUES (?, ?, ?, ?)";
    $stmt_clients = $conn->prepare($sql_clients);
    $stmt_clients->bind_param("ssss", $full_name, $email, $diet, $address);
    $stmt_clients->execute();

    // Get the last inserted client ID
    $refferenced_id = $stmt_clients->insert_id;

    // Insert data into users table
    $sql_users = "INSERT INTO users (referenced_id, username, password) VALUES (?, ?, ?)";
    $stmt_users = $conn->prepare($sql_users);
    $stmt_users->bind_param("iss", $refferenced_id, $username, $password); // Password is not hashed
    $stmt_users->execute();

    // Commit transaction
    $conn->commit();

    // Set session variables
    $_SESSION['full_name'] = $full_name;
    $_SESSION['refferenced_id'] = $refferenced_id;

    // Redirect to a welcome or home page
    header("Location: login.html");
    exit();
} catch (Exception $e) {
    // Rollback transaction in case of error
    $conn->rollback();
    echo "Error: " . $e->getMessage();
}

// Close statements and connection
$stmt_clients->close();
$stmt_users->close();
$conn->close();
?>
