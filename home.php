<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'client') {
    header("Location: login.html");
    exit();
}

$username = $_SESSION['username'];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nutrition Consultation Services</title>
    <link rel="icon" href="img/favicon.png">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/normalize.css">
        

    
       
        <link rel="stylesheet" href="css/magnific-popup.css">

    
    <!-- CSS Styles -->
  <style type="text/css">
    /* General Styles */
body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    background-image: url(img/img1.jpg);
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    color: #343a40;
    box-sizing: border-box;
}


/* Header Styles */
.header {
    
    padding: 20px 0;
    
}

.header-inner {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.main-menu {
    display: flex;
}

.main-menu .navigation {
    margin-right: auto; /* Pushes the navigation menu to the left */
    
}

.menu {
    list-style: none;
    padding: 0;
    margin: 0;
}

.menu li {
    display: inline-block;
    margin-right: 20px;
}

.menu li:last-child {
    margin-right: 0;
}

.menu li a {
    text-decoration: none;
    color: dark red;
    font-weight: 16px;
}

.menu li.active a {
    color: #17a2b8;
}
.menu li a:hover{
color:blue;
}
.get-quote .btn {
    background-color: #17a2b8;
    margin-left: 1400px;
    color: #fff;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    display: inline-block;
    transition: background-color 0.3s ease;
}

.get-quote .btn:hover {
    background-color: #138496;
}

/* Welcome Message Styles */
.welcome-message {
    text-align: right;
}

.welcome-message p {
    margin: 0;
    font-weight: 500;
}


/* Responsive Styles */
@media (max-width: 100%) {
    .header-inner {
        flex-direction: column;
        align-items: stretch;
    }

    .col-lg-2, .col-lg-3 {
        margin-top: 10px;
    }

    .welcome-message {
        text-align: right;
    }
}

.tabs-section {
    padding: 20px 0;
    
}

.tabs {
    list-style: none;
    padding: 0;
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
}

.tabs li {
    margin: 0 10px;
}

.tabs li a {
    color: #17a2b8;
    text-decoration: none;
    padding: 10px 20px;
    border: 2px solid #17a2b8;
    border-radius: 5px;
    font-weight: 600;
    transition: background-color 0.3s, color 0.3s;
}

.tabs li a:hover,
.tabs li a.active {
    background-color: #17a2b8;
    color: #ffffff;
}

.tab_container .tab_content {
    display: none;
}

.tab_container .tab_content.active {
    display: block;
}

.main .wrapper {
    display: flex;
    align-items: center;
    padding: 20px;
    
    
    border-radius: 5px;
    margin-bottom: 20px;
}

.main .wrapper figure {
    margin-right: 20px;
}

.main .wrapper .extra-wrap .indent .title {
    font-size: 24px;
    color: #17a2b8;
}

.main .wrapper .extra-wrap .indent .p5 {
    margin: 10px 0;
}

.main .wrapper .btn-wrap .button a {
    background-color: #17a2b8;
    color: #ffffff;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 5px;
    font-weight: 600;
    display: inline-block;
}

#content {
    padding: 40px 0;
}

#content .container_12 .wrapper img-indent-bot {
    margin-bottom: 20px;
}

.grid_4 h3 {
    font-size: 24px;
    margin-bottom: 20px;
}

.list-1 {
    list-style: none;
    padding: 0;
}

.list-1 li {
    margin-bottom: 10px;
}

.list-1 li a {
    color: #17a2b8;
    text-decoration: none;
    font-weight: 500;
}

.list-1 li a:hover {
    text-decoration: underline;
}

/* Responsive Styles */
@media (max-width: 768px) {
    .header-inner {
        flex-direction: column;
    }

    .header .main-menu .navigation .menu {
        flex-direction: column;
        align-items: center;
    }

    .header .main-menu .navigation .menu li {
        margin: 10px 0;
    }

    .tabs {
        flex-direction: column;
    }

    .tabs li {
        margin: 10px 0;
    }
}


/* Footer styles */
footer {
    background:#1A76D1;
    color: white;
    font-size: 16px;
    font-family: "Poppins", sans-serif;
    width: 70%;
    justify-content: center;
    margin-left: 150px;

}

/* Footer layout */
.row {
    padding: 1em 1em;
}

.row.primary {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr 2fr;
    align-items: stretch;
}

  

/* About section */
.about p {
    text-align: justify;
    line-height: 2;
    margin: 0;
}

/* Social icons */


/* Copyright section */
.copyright {
    padding: 0.3em 1em;
    background-color: #25262e;
}

.footer-menu {
    float: left;
    margin-top: 10px;
}

.footer-menu a {
    color: #cfd2d6;
    padding: 6px;
    text-decoration: none;
}

.footer-menu a:hover {
    color: #27bcda;
}

.footer .copyright .copyright-content p a{
  color:#fff;
  font-weight:400;
  text-decoration:underline;
  display:inline-block;
  margin-left:4px;

  </style>
      
</head>
<body>
    <header class="header">
        <div class="header-inner">
            <div class="container">
                <div class="inner">
                    <div class="col-lg-7 col-md-9 col-12">
                        <!-- Main Menu -->
                        <div class="main-menu">
                            <nav class="navigation">
                                <ul class="nav menu">
                                    <li class="active"><a href="#home">Home</a></li>
                                    <li><a href="comunication.php">comunication</a></li>
                                    <li><a href="profile.html">Profile</a></li>
                                    <li><a href="appointment.html">Appointments</a></li>
                                    <li><a href="chat.php">Chat</a></li>
                                    <li><a href="consultations.php">consultation</a></li>
                                </ul>
                            </nav>
                        </div>
                        <!--/ End Main Menu -->
                    </div>
                    <div class="col-lg-2 col-12">
                        <div class="get-quote">
                            <a href="#" class="btn" id="logout-button">Logout</a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-12">
                        <div class="welcome-message">
                            <p>Welcome, <?php echo htmlspecialchars($username); ?>!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Tabs Section -->
    <section class="tabs-section">
        <div class="container">
            <ul class="tabs">
                <li><a href="#tab1">Best Diet Advices</a></li>
                <li><a href="#tab2">Exercise & Physical Fitness</a></li>
                <li><a href="#tab3">Weight Loss Programs</a></li>
            </ul>
            <div class="tab_container">
                <div id="tab1" class="tab_content">
                    <div class="main">
                        <div class="wrapper">
                            <figure class="img-indent-r"><img src="images/page1-img1.jpg" alt=""></figure>
                            <div class="extra-wrap">
                                <div class="indent"> 
                                    <strong class="title">Best</strong>
                                    <p class="p5">Diet Advice You've<br> Never Heard Before</p>
                                    <div class="btn-wrap">
                                        <span class="button"> <a href="#"><strong>Read More</strong></a> </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tab2" class="tab_content">
                    <div class="main">
                        <div class="wrapper">
                            <figure class="img-indent-r"><img src="images/page1-img2.jpg" alt=""></figure>
                            <div class="extra-wrap">
                                <div class="indent"> 
                                    <strong class="title">Exercise</strong>
                                    <p class="p5">And Physical<br> Fitness</p>
                                    <div class="btn-wrap">
                                        <span class="button"> <a href="#"><strong>Read More</strong></a> </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tab3" class="tab_content">
                    <div class="main">
                        <div class="wrapper">
                            <figure class="img-indent-r"><img src="img/img3.jpg" alt=""></figure>
                            <div class="extra-wrap">
                                <div class="indent"> 
                                    <strong class="title">Fastest</strong>
                                    <p class="p5">Weight Loss<br> Programs</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Content Section -->
    <section id="content">
        <div class="main">
            <div class="container_12">
                <div class="wrapper img-indent-bot">
                    <article class="grid_4">
                        <h3>Weight-Loss Basics</h3>
                        <ul class="list-1">
                            <li><a href="#">Count Calories</a></li>
                            <li><a href="#">Weight Loss Basics</a></li>
                            <li><a href="#">Healthy Eating</a></li>
                            <li><a href="#">Eating Out</a></li>
                            <li><a href="#">Nutrition</a></li>
                            <li><a href="#">About Diets</a></li>
                            <li><a href="#">Emotional Eating</a></li>
                            <li><a href="#">Exercise for Weight Loss</a></li>
                            <li><a href="#">Obesity & Health</a></li>
                        </ul>
                    </article>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer Area -->
    <footer id="footer" class="footer ">
      <!-- Footer Top -->
      <div class="footer-top">
        <div class="container">
          <div class="row">
            <div class="col-lg-3 col-md-6 col-12">
              <div class="single-footer">
                <h2>About Us</h2>
                <p>where the the providers of the online nutrition consuling services.</p>
                <!-- Social -->
                <ul class="social">
                  <li><a href="#"><i class="icofont-facebook"></i></a></li>
                  <li><a href="#"><i class="icofont-google-plus"></i></a></li>
                  <li><a href="#"><i class="icofont-twitter"></i></a></li>
                  <li><a href="#"><i class="icofont-vimeo"></i></a></li>
                  <li><a href="#"><i class="icofont-pinterest"></i></a></li>
                </ul>
                <!-- End Social -->
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12">
              <div class="single-footer f-link">
                <h2>Quick Links</h2>
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-12">
                    <ul>
                      <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Home</a></li>
                      <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>About Us</a></li>
                      <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Services</a></li> 
                    </ul>
                  </div>
                  <div class="col-lg-6 col-md-6 col-12">
                    <ul>
                      <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Consuling</a></li>
                      <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Contact Us</a></li> 
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12">
              <div class="single-footer">
                <h2>Open Hours</h2>
                <p>hours you can find our consultants.</p>
                <ul class="time-sidual">
                  <li class="day">Monday - Fridayp <span>8.00-20.00</span></li>
                  <li class="day">Saturday <span>9.00-18.30</span></li>
                  <li class="day">Monday - Thusday <span>9.00-15.00</span></li>
                </ul>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12">
              <div class="single-footer">
                <h2>Newsletter</h2>
                <p>subscribe to our newsletter to get allour news in your inbox.. Lorem ipsum dolor sit amet, consectetur adipisicing elit,</p>
                <form action="mail/mail.php" method="get" target="_blank" class="newsletter-inner">
                  <input name="email" placeholder="Email Address" class="common-input" onfocus="this.placeholder = ''"
                    onblur="this.placeholder = 'Your email address'" required="" type="email">
                  <button class="button"><i class="icofont icofont-paper-plane"></i></button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--/ End Footer Top -->
      <!-- Copyright -->
      <div class="copyright">
        <div class="container">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
              <div class="copyright-content">
                <p>© Copyright 2018  |  All Rights Reserved by gkings </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--/ End Copyright -->
    </footer>

    <script>
        document.getElementById('logout-button').addEventListener('click', function(event) {
            event.preventDefault();
            if (confirm("Are you sure you want to logout?")) {
                window.location.href = 'index.html';
            }
        });
    </script>
</body>
</html>
