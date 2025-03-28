<?php
include "config.php"; // Database connection

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the database name
$dbnameQuery = "SELECT DATABASE() as dbname";
$dbnameResult = $conn->query($dbnameQuery);

if (!$dbnameResult) {
    die("Error fetching database name: " . $conn->error);
}

$dbnameRow = $dbnameResult->fetch_assoc();
$dbname = $dbnameRow['dbname'] ?? '';

if (!$dbname) {
    die("Database name could not be retrieved.");
}

$tables = [];

// Fetch tables that have a 'product_name' column and contain data
$query = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = ? AND COLUMN_NAME = 'product_name'";
$stmt = $conn->prepare($query);
if ($stmt) {
    $stmt->bind_param("s", $dbname);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $table_name = $row['TABLE_NAME'];

        // Check if the table contains products
        $countQuery = "SELECT COUNT(*) as total FROM `$table_name` WHERE product_name IS NOT NULL";
        $countStmt = $conn->prepare($countQuery);
        if ($countStmt) {
            $countStmt->execute();
            $countResult = $countStmt->get_result();
            $countRow = $countResult->fetch_assoc();

            if ($countRow['total'] > 0) {
                $tables[] = $table_name;
            }
            $countStmt->close();
        }
    }
    $stmt->close();
}

// Get the selected table from the URL
$selected_table = isset($_GET['table']) ? htmlspecialchars($_GET['table']) : '';

$products = [];

if (!empty($selected_table) && in_array($selected_table, $tables)) {
    // Fetch products from the selected table
    $productQuery = "SELECT * FROM `$selected_table`";
    $productResult = $conn->query($productQuery);

    if ($productResult) {
        while ($productRow = $productResult->fetch_assoc()) {
            $products[] = $productRow;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                        <li><a
                                href="product.php?table=<?= htmlspecialchars($table); ?>"><?= ucfirst(htmlspecialchars($table)); ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </li>
            <li><a href="about.php">About</a></li>
            <li><a href="contact.php">Contact Us</a></li>
        </ul>
    </nav>
    <main>
        <div class="about-container">
            <div class="about-background"></div>
            <div class="intro-about">
                <h1 style=" color: whitesmoke; font-size: 58px;">About Us</h1>
                <p style=" color: whitesmoke;">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p> <br>
                <a href="#" style="color: blue;">About Us</a>
            </div>
            <div class="about-content">
                <div class="box">
                    <h1>About us</h1><br>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum quaerat class iure numquam
                        enim minus fuga illo laboriosam maiores adipisci! Dolorum voluptas ipsam sequi obcaecati odio
                        voluptatum optio sit est.</p>
                </div>
                <div class="box"></div>
            </div>
        </div>
        <div class="about-container">
            <div class="about-why-shoose-us">
                <h1>Why <span>Choose Us</span></h1>
                <div class="card">
                    <h1><i class="fa-solid fa-quote-left"></i></h1>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Velit, sed?</p>
                </div>
                <div class="card">
                    <h1><i class="fa-solid fa-quote-left"></i></h1>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Velit, sed?</p>
                </div>
                <div class="card">
                    <h1><i class="fa-solid fa-quote-left"></i></h1>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Velit, sed?</p>
                </div>
            </div>
        </div>
    </main>
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
            <li><a href="contact.php">Contact</a></li>
        </ul>
        <ul>
            <h1>Contact Us</h1>
            <li><a href="#"><i class="fa-solid fa-location-dot"></i> About</a></li>
            <li><a href="#"><i class="fa-solid fa-envelope"></i> About</a></li>
            <li><a href="#"><i class="fa-solid fa-phone"></i> About</a></li>
            <li><a href="#"><i class="fa-solid fa-box"></i> About</a></li>
        </ul>
    </footer>

</body>

</html>