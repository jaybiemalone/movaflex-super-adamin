<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

<div class="logo"> 
    <img src="asset/MOVAFLEX2.png" alt="MOVAFLEX Image" width="200">
</div>

<nav>
    <ul>
        <li><a href="home.php">Home</a></li>
        <li>
            <a href="product.php">Product ▼</a>
            <ul class="dropdown">
                <?php foreach ($tables as $table): ?>
                    <li><a href="product.php?table=<?= htmlspecialchars($table); ?>"><?= ucfirst(htmlspecialchars($table)); ?></a></li>
                <?php endforeach; ?>
            </ul>
        </li>
        <li><a href="about.php">About</a></li>
        <li><a href="contact.php">Contact Us</a></li>
    </ul>
</nav>


    <div class="contact-us-container">
        <div class="section-contact">
            <div class="contact-display">
                <h1>Contact Us</h1>
                <span><a href="home.php">HOME</a> / Contact Us</span>
            </div>
        </div>
        <div class="section-contact">
            <div class="box"></div>
            <div class="box">
                <ul>
                    <li class="info">
                        <ul>
                            <li><h1>KNOW MORE ABOUT HOW YOU CAN REACH US!</h1></li>
                            <li><p>Need answers to your inquiries? Below are our contact details and business hours, so you know when and how to reach us.</p></li>
                        </ul>
                    </li>
                    <li class="info">
                        <ul>
                            <li>
                                <div class="box-info">
                                    <div class="details">
                                    <i class="fa-solid fa-envelope"></i>
                                    </div>
                                    <div class="details">
                                        <h3>Email Us</h3>
                                        <p>sales@aim.com.ph</p>
                                        <p>marketing@aim.com.ph</p>
                                        <p>technical@aim.com.ph</p>
                                    </div>
                                </div>
                                <div class="box-info">
                                    <div class="details">
                                    <i class="fa-solid fa-phone"></i>
                                    </div>
                                        <div class="details">
                                            <h3>Call Us</h3>
                                            <p>Tel. No. : (02) 8633 7526 ; 8532 5882</p>
                                            <p>Mobile No. : 0917 - 8884494</p>
                                        </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="info">
                        <ul>
                            <li>
                                <div class="box-info">
                                    <div class="details">
                                    <i class="fa-solid fa-location-dot"></i>
                                    </div>
                                        <div class="details">
                                            <h3>Address</h3>
                                            <p>136 Calbayog St. Brgy. Highway Hills
                                            Mandaluyong City</p>
                                        </div>
                                </div>
                                <div class="box-info">
                                    <div class="details">
                                    <i class="fa-solid fa-suitcase"></i>
                                    </div>
                                        <div class="details">
                                            <h3>Business Hours</h3>
                                            <p>Monday - Friday 9:00AM - 6:00PM</p>
                                        </div>
                                </div>
                            </li>
                            <li></li>
                        </ul>
                    </li>
                    <li class="info"></li>
                </ul>
            </div>
        </div>
        <div class="section-contact"></div>
        <div class="section-contact"></div>
            <footer> 
                <ul>
                    <h1>Our Product</h1>
                    <li><a href="#">Office Chair</a></li>
                    <li><a href="#">Table</a></li>
                    <li><a href="#">Office/Table</a></li>
                </ul>
                <ul>
                    <h1>Menu Link</h1>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
                <ul>
                    <h1>Contact Us</h1>
                    <li><a href="#"><i class="fa-solid fa-location-dot"></i> About</a></li>
                    <li><a href="#"><i class="fa-solid fa-envelope"></i> About</a></li>
                    <li><a href="#"><i class="fa-solid fa-phone"></i> About</a></li>
                    <li><a href="#"><i class="fa-solid fa-box"></i> About</a></li>
                </ul>
            </footer>
    </div>
</body>
</html>