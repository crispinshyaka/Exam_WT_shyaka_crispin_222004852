<?php
// Include your database connection file
include 'database.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define variables and initialize with empty values
    $client_id = $channel_type = "";

    // Processing form data when form is submitted
    $client_id = trim($_POST["client_id"]);
    $channel_type = trim($_POST["channel_type"]);

    // Prepare an INSERT statement
    $sql = "INSERT INTO communication_channel (client_id, channel_type) VALUES (?, ?)";

    if ($stmt = $mysqli->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("is", $param_client_id, $param_channel_type);

        // Set parameters
        $param_client_id = $client_id;
        $param_channel_type = $channel_type;

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            // Redirect to success page
            header("location: index.php");
            exit();
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        $stmt->close();
    }

    // Close connection
    $mysqli->close();
}
?>
