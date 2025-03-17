<?php
include "config.php"; // Database connection

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the database name
$dbnameQuery = "SELECT DATABASE() as dbname";
$dbnameResult = $conn->query($dbnameQuery);
$dbnameRow = $dbnameResult->fetch_assoc();
$dbname = $dbnameRow['dbname'];

$tables = [];

// Fetch tables that have a 'product_name' column and contain data
$query = "SELECT TABLE_NAME 
          FROM INFORMATION_SCHEMA.COLUMNS 
          WHERE TABLE_SCHEMA = ? AND COLUMN_NAME = 'product_name'";

$stmt = $conn->prepare($query);
$stmt->bind_param("s", $dbname);
$stmt->execute();
$result = $stmt->get_result();

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $table_name = $row['TABLE_NAME'];

        // Check if the table contains products
        $countQuery = "SELECT COUNT(*) as total FROM `$table_name` WHERE product_name IS NOT NULL";
        $countResult = $conn->query($countQuery);

        if ($countResult) {
            $countRow = $countResult->fetch_assoc();
            if ($countRow['total'] > 0) {
                $tables[] = $table_name;
            }
        }
    }
}

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movaflex</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>

    <div class="logo">
        <img src="asset/MOVAFLEX2.png" alt="MOVAFLEX Image" width="200">
    </div>

    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
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

    <main>
    <div class="product-container">
            <?php foreach ($tables as $table): ?>
                <div class="category">
                    <div class="category-name">
                        <h2><?= ucfirst(htmlspecialchars($table)); ?></h2>
                    </div>
                    <div class="product-content">
                        <?php
                        $productQuery = "SELECT * FROM `$table` WHERE product_name IS NOT NULL";
                        $productResult = $conn->query($productQuery);

                        if ($productResult->num_rows > 0):
                            while ($product = $productResult->fetch_assoc()):
                        ?>
                            <div class="product">
                                <img src="<?= htmlspecialchars($product['image_url'] ?? 'default.jpg'); ?>" alt="<?= htmlspecialchars($product['product_name']); ?>" width="150">
                                <h3><?= htmlspecialchars($product['product_name']); ?></h3>
                                <p>Price: ₱ <?= htmlspecialchars($product['price']); ?></p>
                                <p>Special: <?= htmlspecialchars($product['special_name'] ?? 'N/A'); ?></p>
                                <p>Stock: <?= htmlspecialchars($product['quantity']); ?></p>
                            </div>
                        <?php 
                            endwhile;
                        else:
                            echo "<p>No products available.</p>";
                        endif;
                        ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

</body>
</html>
