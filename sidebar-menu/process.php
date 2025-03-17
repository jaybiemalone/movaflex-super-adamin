<?php
include "config.php"; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['category'], $_POST['name'], $_POST['quantity'], $_POST['special_name'], $_POST['price'], $_FILES["product_image"])) {
        
        $category = preg_replace("/[^a-zA-Z0-9_]/", "", $_POST['category']); // Sanitize category
        $product_name = trim($_POST['name']);
        $quantity = (int)$_POST['quantity'];
        $special_name = trim($_POST['special_name']);
        $price = (float)$_POST['price'];

        // Validate if category table exists
        $tableCheckQuery = "SHOW TABLES LIKE '$category'";
        $result = $conn->query($tableCheckQuery);
        if ($result->num_rows != 1) {
            die("Error: Selected category does not exist.");
        }

        // Handle file upload
        $targetDir = "uploads/";
        $fileName = time() . "_" . basename($_FILES["product_image"]["name"]); // Unique file name
        $targetFilePath = $targetDir . $fileName;
        $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
        $allowedTypes = ["jpg", "jpeg", "png", "gif"];

        if (in_array($imageFileType, $allowedTypes) && move_uploaded_file($_FILES["product_image"]["tmp_name"], $targetFilePath)) {
            
            // Check if product exists
            $check_sql = "SELECT id FROM `$category` WHERE product_name = ?";
            $stmt = $conn->prepare($check_sql);
            $stmt->bind_param("s", $product_name);
            $stmt->execute();
            $stmt->store_result();
            
            if ($stmt->num_rows > 0) {
                // Update existing product
                $update_sql = "UPDATE `$category` SET quantity = quantity + ?, product_picture = ?, special_name = ?, price = ? WHERE product_name = ?";
                $update_stmt = $conn->prepare($update_sql);
                $update_stmt->bind_param("issds", $quantity, $fileName, $special_name, $price, $product_name);
                $update_stmt->execute();
                $update_stmt->close();
            } else {
                // Insert new product
                $insert_sql = "INSERT INTO `$category` (product_name, product_picture, quantity, special_name, price) VALUES (?, ?, ?, ?, ?)";
                $insert_stmt = $conn->prepare($insert_sql);
                $insert_stmt->bind_param("ssisd", $product_name, $fileName, $quantity, $special_name, $price);
                $insert_stmt->execute();
                $insert_stmt->close();
            }
            $stmt->close();

            // Redirect to product.php
            header("Location: add-product.php");
            exit();
        } else {
            echo "Invalid file type or upload error.";
        }
    } else {
        echo "Missing required fields.";
    }
}

$conn->close();
?>