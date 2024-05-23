<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: home1.php');
    exit;
}

$username = $_SESSION['username'];
$conn = mysqli_connect('localhost', 'root', '', 'nutrition_consultation_service');

$query = "SELECT refferenced_id FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$referenced_id = $row['refferenced_id'];

$query = "SELECT full_name FROM consultants WHERE consultant_id = '$referenced_id'";
$result = mysqli_query($conn, $query);

if ($result === false) {
    echo "Error: " . mysqli_error($conn);
    exit;
}

$row = mysqli_fetch_assoc($result);

if ($row === null) {
    echo "Error: Consultant not found.";
    exit;
}

$consultant_name = $row['full_name'];


// Fetch all clients who have sent messages
function getClientInfo($clientId)
{
    global $conn;
    $query = "SELECT full_name, email FROM clients WHERE client_id = '$clientId'";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($result);
}

// Function to display chat messages
function displayClientMessages()
{
    global $conn;

    // Query to get the latest message for each client
    $query = "
        SELECT m1.client_id, m1.message, c.full_name
        FROM messages m1
        INNER JOIN clients c ON m1.client_id = c.client_id
        WHERE m1.date_sent = (
            SELECT MAX(m2.date_sent)
            FROM messages m2
            WHERE m2.client_id = m1.client_id
        )
        ORDER BY m1.date_sent DESC
    ";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $clientId = $row['client_id'];
        $clientName = htmlspecialchars($row['full_name']);
        $message = htmlspecialchars($row['message']);

        echo "<div class='client-message'>
                <div class='client-name'><a href='chat1.php?client_id=$clientId'>{$clientName}</a></div>
                <div class='client-message-preview'>{$message}</div>
              </div>";
    }
}


// Function to display chat messages
// Function to display chat messages for a specific client
function displayMessages()
{
    global $conn, $referenced_id, $consultant_name;

    $client_id = isset($_GET['client_id']) ? $_GET['client_id'] : null;

    if ($client_id === null) {
        echo "<p>Please select a client to view messages.</p>";
    } else {
        // Retrieve the client's name
        $clientInfo = getClientInfo($client_id);
        $client_name = $clientInfo['full_name'];

        $query = "SELECT * FROM messages WHERE (client_id = '$client_id' AND consultant_id = '$referenced_id') OR (client_id = '$referenced_id' AND consultant_id = '$client_id') ORDER BY date_sent ASC";
        $result = mysqli_query($conn, $query);

        // Display messages
        while ($row = mysqli_fetch_assoc($result)) {
            // Determine sender's role (consultant or client)
            $isConsultant = $row['sender'] == 'consultant';
            $sender = $isConsultant ? $consultant_name : $client_name;
            $messageColor = $isConsultant ? 'green' : 'blue';
            $messageAlignment = $isConsultant ? 'right' : 'left';
            $messagePrefix = $isConsultant ? 'Sent on' : 'Received on';

            echo "<div style='text-align: $messageAlignment; margin: 10px 0;'>
                    <div style='display: inline-block; background-color: $messageColor; color: white; padding: 10px; border-radius: 10px; max-width: 60%;'>
                        <strong>" . htmlspecialchars($sender) . "</strong>: " . htmlspecialchars($row['message']) . "<br>
                        <span style='font-size: 12px; color: #eee;'>$messagePrefix " . $row['date_sent'] . "</span>
                    </div>
                  </div>";
        }
    }
}


// Function to send message
function sendMessage()
{
    global $conn, $referenced_id;

    if (isset($_POST['message']) && isset($_GET['client_id'])) {
        $message = mysqli_real_escape_string($conn, $_POST['message']);
        $client_id = $_GET['client_id'];

        $query = "INSERT INTO messages (client_id, consultant_id, message, sender) VALUES ('$client_id', '$referenced_id', '$message', 'consultant')";
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
    <title>Consultant Messages - Nutrition Consultation Platform</title>
    <link rel="stylesheet" type="text/css" href="c2.css">
</head>

<body>
    <header>
        <nav>
            <div class="logo">
                <h2><span style="color: #1aa3ff;">Nutrition -</span>Consultation Platform</h2>
            </div>
            <ul class="nav-links">
                <li><a href="home2.php" class="nav-link">Home</a></li>
                <li><a href="documents.html" class="nav-link">Documents</a></li>
                <li><a href="chat.php" class="nav-link">Messages</a></li>
                <li><a href="profile1.html" class="nav-link">Profile</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <div class="Messages">
            <h2>Client Messages</h2>
            <?php displayClientMessages(); ?>
        </div>

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
        <p class="footer-copyright">&copy; 2024 Nutrition Consultation Platform. All rights reserved.</p>
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

        function selectClient(clientId) {
            window.location.href = `chat.php?client_id=${clientId}`;
        }
    </script>
</body>

</html>
