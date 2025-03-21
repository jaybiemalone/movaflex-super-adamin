<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="style/style.css">
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
        <div class="section-contact"></div>
        <div class="section-contact"></div>
        <div class="section-contact"></div>
        <div class="section-contact"></div>
    </div>
</body>
</html>