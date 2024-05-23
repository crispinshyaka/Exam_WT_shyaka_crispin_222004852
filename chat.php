<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: home.php');
    exit;
}

$username = $_SESSION['username'];
$conn = mysqli_connect('localhost', 'root', '', 'nutrition_consultation_service');

$query = "SELECT refferenced_id FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$referenced_id = $row['refferenced_id'];

$query = "SELECT full_name FROM clients WHERE client_id = '$referenced_id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$full_name = $row['full_name'];

$client_name = $full_name;

// Function to display chat messages
function displayMessages() {
    global $conn, $referenced_id, $client_name;

    $query = "SELECT * FROM messages WHERE client_id = '$referenced_id' ORDER BY date_sent ASC";
    $result = mysqli_query($conn, $query);

    // Display messages
    while ($row = mysqli_fetch_assoc($result)) {
        // Determine sender's role (client)
        $sender = $client_name;
        $messageColor = 'green';
        $messageAlignment = 'right';
        $messagePrefix = 'Sent on';

        echo "<div style='text-align: $messageAlignment; margin: 10px 0;'>
                <div style='display: inline-block; background-color: $messageColor; color: white; padding: 10px; border-radius: 10px; max-width: 60%;'>
                    <strong>" . htmlspecialchars($sender) . "</strong>: " . htmlspecialchars($row['message']) . "<br>
                    <span style='font-size: 12px; color: #eee;'>$messagePrefix " . $row['date_sent'] . "</span>
                </div>
              </div>";
    }
}

// Function to send message
function sendMessage() {
    global $conn, $referenced_id;

    if (isset($_POST['message'])) {
        $message = mysqli_real_escape_string($conn, $_POST['message']);

        $query = "INSERT INTO messages (client_id, message, sender) VALUES ('$referenced_id', '$message', 'client')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            // Redirect to prevent form resubmission
            header("Location: {$_SERVER['REQUEST_URI']}");
            exit;
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}

// Send message if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    sendMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Legal Services Platform</title>
    <link rel="stylesheet" type="text/css" href="c1.css">
</head>
<body>
    <header>
        <nav>
            <div class="logo">
                <h2><span style="color: #1aa3ff;">nutrition -</span>consultation Platform</h2>
            </div>
            <ul class="nav-links">
                <li><a href="index.php" class="nav-link">Home</a></li>
                <li><a href="documents.php" class="nav-link">Documents</a></li>
                <li><a href="chat.php" class="nav-link">Messages</a></li>
                <li><a href="profile.php" class="nav-link">Profile</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <div class="chat">
            <div class="chat-header">
                <h2>Send Message</h2>
            </div>
            <div class="chat-messages">
                <?php displayMessages(); ?>
            </div>
            <div class="chat-input">
                <form method="post">
                    <textarea name="message" placeholder="Type your message..."></textarea>
                    <button type="submit">Send</button>
                </form>
            </div>
        </div>
    </div>

    <button class="logout-btn" onclick="logout()">Logout</button>
    <footer>
        <p class="footer-copyright">&copy; 2024 nutrition- consultation Platform. All rights reserved.</p>
    </footer>
    <script>
        function logout() {
            const confirmLogout = confirm("Are you sure you want to logout?");
            if (confirmLogout) {
                // Send a request to logout.php using AJAX
                const xhr = new XMLHttpRequest();
                xhr.open('GET', 'logout1.php', true);
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        // Redirect the user to index.html after successful logout
                        window.location.href = "index.html";
                    } else {
                        // Handle errors if needed
                        console.error('Error:', xhr.statusText);
                    }
                };
                xhr.onerror = function () {
                    // Handle network errors if needed
                    console.error('Network error');
                };
                xhr.send();
            }
        }
        window.addEventListener('scroll', () => {
            const header = document.querySelector('header');
            header.classList.toggle('scrolled', window.scrollY > 0);
        });
    </script>
</body>
</html>
