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
                        $productStmt = $conn->prepare($productQuery);

                        if ($productStmt) {
                            $productStmt->execute();
                            $productResult = $productStmt->get_result();

                            if ($productResult->num_rows > 0):
                                while ($product = $productResult->fetch_assoc()):
                                    $imagePath = "sidebar-menu/uploads/" . htmlspecialchars($product['product_picture']);
                                    $defaultImage = "sidebar-menu/uploads/default.jpg";

                                    // Check if the file exists
                                    if (!file_exists($_SERVER['DOCUMENT_ROOT'] . "/" . $imagePath) || empty($product['product_picture'])) {
                                        $imagePath = "super-admin/sidebar-menu/uploads/default.jpg"; // Fallback image
                                    }
                        ?>
                                    <div class="product">
                                    <img src="<?= htmlspecialchars($imagePath); ?>" alt="<?= htmlspecialchars($product['product_name']); ?>" width="150">
                                        <h3><?= htmlspecialchars($product['product_name']); ?></h3>
                                        <p>Price: ₱ <?= htmlspecialchars($product['price']); ?></p>
                                        <p><?= htmlspecialchars($product['special_name'] ?? 'N/A'); ?></p>
                                        <p>Stock: <?= htmlspecialchars($product['quantity']); ?></p>
                                    </div>
                        <?php 
                                endwhile;
                            else:
                                echo "<p>No products available.</p>";
                            endif;
                            $productStmt->close();
                        }
                        ?>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>
    </main>

</body>
</html>
