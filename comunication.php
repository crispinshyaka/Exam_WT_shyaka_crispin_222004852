<?php
include 'database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>communication</title>
    <style type="text/css">
        @font-face {
  font-family: "Poppins-Regular";
  src: url("../../fonts/poppins/Poppins-Regular.ttf");
}

@font-face {
  font-family: "Poppins-SemiBold";
  src: url("../../fonts/poppins/Poppins-SemiBold.ttf");
}
body {
    margin: 0;
    padding: 0;
    font-family: "Poppins-Regular";
    position: relative;
    background-image: url('../../img/2.jpg');
    background-size: cover;
}

body::after {
    content: '';
    opacity: 0.5;
    position: fixed;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    z-index: -1;
    background-color: rgba(0, 0, 0, 0.5);
}

header {
    background-color: rgba(0, 0, 0, 0.1);
    padding: 10px 0;
}

nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 50px;
}

.logo h2 {
    color: #fff;
    margin: 0;
}

.logo {
    margin-left: 20px;
}

.nav-links {
    list-style: none;
    display: flex;
    margin-right: 560px;
}

.nav-links li {
    margin-right: 20px;
}

.nav-links li a {
    color: #fff;
    text-decoration: none;
    transition: color 0.3s ease;
}

.nav-links li a:hover {
    color: #e6e6e6;
    transform: scale(1.1);
    transition: transform 0.3s ease;
    position: relative;
}

.nav-links li a:hover::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -5px;
    width: 100%;
    height: 2px;
    background-color: black;
}


.form-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: calc(100vh - 150px); /* Adjust based on header and footer height */
}

.form-box {
    margin-top: 20px;
    width: 400px;
    padding-left: 30px;
    padding-right: 30px;
    padding-bottom: 20px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

.form-title {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
    font-size: 24px;
}

.form-group {
    margin-bottom: 20px;
    display: inline-block;
    width: 45%; /* Adjust as needed */
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    color: #666;
    font-weight: bold;
}

.form-group input[type="text"] {
    width: calc(100% - 20px); /* Adjust based on label width and margin */
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    transition: all 0.3s ease;
}

.form-group input[type="text"]:focus {
    outline: none;
    border-color: #1aa3ff;
    box-shadow: 0 0 5px rgba(26, 163, 255, 0.5);
}

.form-group input[type="text"][readonly] {
    background-color: #f9f9f9;
}

.update-btn {
    width: 100%;
    padding: 10px;
    background-color: #1aa3ff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.update-btn:hover {
    background-color: #007acc;
}

.logout-btn {
    position: absolute;
    top: 20px;
    right: 20px;
    background-color: #f44336;
    color: white;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    border-radius: 15px;
    transition: background-color 0.3s ease;
}

.logout-btn:hover {
    background-color: #d32f2f;
}

footer {
    color: #fff;
    text-align: center;
    position: fixed;
    bottom: 0;
    width: 100%;
}

.footer-copyright {
    margin-top: 50px;
    color: #ccc;
    font-size: 14px;
    position: absolute;
    bottom: 10px;
    left: 50%;
    transform: translateX(-50%);
}

h3 {
    text-align: center;
}

    </style>
</head>
<body>
    <header>
        <nav>
            <div class="logo">
                <h2><span style="color: #1aa3ff;">nutrition -</span>consultation Platform</h2>
            </div>
            <ul class="nav-links">
                <li class="active"><a href="#home">Home</a></li>
                                    <li><a href="comunication.php">comunication</a></li>
                                    <li><a href="profile.html">Profile</a></li>
                                    <li><a href="appointment.html">Appointments</a></li>
                                    <li><a href="chat.php">Chat</a></li>
                                    <li><a href="consultations.php">consultation</a></li>
            </ul>
        </nav>
    </header>
    <div class="form-container">
        <div class="form-box">
            <h2 class="form-title">communication</h2>
            <form  action="com.php" method="POST">
                <div class="form-group">
                    <label for="client_id">ID:</label>
                    <input type="number" id="client_id" name="client_id" value="<?php echo $client_id;?>" required>
                </div>
                <div class="form-group">
                    <label for="channel_type">channel:</label>
                    <input type="text"  name="channel_type" value="<?php echo $channel_type;?>" required>
                </div>
                
                <button type="submit" class="Submit-btn">insert</button>
            </form>
        </div>
    </div>
        <button class="logout-btn" onclick="logout()">Logout</button>
    <footer>
        <p class="footer-copyright">&copy; 2024 nutrition-consultation Platform. All rights reserved.</p>
    </footer>
    <script>
                
        function logout() {
            const confirmLogout = confirm("Are you sure you want to logout?");
            if (confirmLogout) {
                // Send a request to logout.php using AJAX
                const xhr = new XMLHttpRequest();
                xhr.open('GET', '../loggedIN/logout.php', true);
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