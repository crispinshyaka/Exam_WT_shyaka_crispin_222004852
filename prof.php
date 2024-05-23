<?php
require_once 'database.php';
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $jobtitle = $_POST["jobtitle"];
    $company = $_POST["company"];
    $experience = $_POST["experience"];
    $skills = $_POST["skills"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    // SQL to update profile data
    $sql = "UPDATE consultant SET fullname='$fullname', email='$email', phone='$phone', address='$address', jobtitle='$jobtitle', company='$company', experience='$experience', skills='$skills', username='$username', password='$password' WHERE id=1"; // Assuming ID of consultant is 1

    if ($conn->query($sql) === TRUE) {
        echo "Profile updated successfully";
    } else {
        echo "Error updating profile: " . $conn->error;
    }
}

$conn->close();
?>