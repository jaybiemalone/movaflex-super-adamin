<?php
include "config.php"; // Database connection

// Fetch available table names that contain 'product_name' column
$tables = [];
$sql = "SHOW TABLES";
$result = $conn->query($sql);

while ($row = $result->fetch_array()) {
    $tableName = $row[0];
    
    // Check if 'product_name' column exists in the table
    $checkColumnSql = "SHOW COLUMNS FROM `$tableName` LIKE 'product_name'";
    $columnResult = $conn->query($checkColumnSql);

    if ($columnResult->num_rows > 0) {
        $tables[] = $tableName; // Store table names that have 'product_name'
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="style.css">
  <link rel="icon" href="/asset/favicon.ico" type="image/x-icon">
  <script type="text/javascript" src="app.js" defer></script>
</head>
<body>
  <nav id="sidebar">
    <ul>
      <li>
        <span class="logo">Movaflex</span>
        <button onclick=toggleSidebar() id="toggle-btn">
          <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="m313-480 155 156q11 11 11.5 27.5T468-268q-11 11-28 11t-28-11L228-452q-6-6-8.5-13t-2.5-15q0-8 2.5-15t8.5-13l184-184q11-11 27.5-11.5T468-692q11 11 11 28t-11 28L313-480Zm264 0 155 156q11 11 11.5 27.5T732-268q-11 11-28 11t-28-11L492-452q-6-6-8.5-13t-2.5-15q0-8 2.5-15t8.5-13l184-184q11-11 27.5-11.5T732-692q11 11 11 28t-11 28L577-480Z"/></svg>
        </button>
      </li>
      <li class="active">
        <a href="dashboard.php">
          <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M520-640v-160q0-17 11.5-28.5T560-840h240q17 0 28.5 11.5T840-800v160q0 17-11.5 28.5T800-600H560q-17 0-28.5-11.5T520-640ZM120-480v-320q0-17 11.5-28.5T160-840h240q17 0 28.5 11.5T440-800v320q0 17-11.5 28.5T400-440H160q-17 0-28.5-11.5T120-480Zm400 320v-320q0-17 11.5-28.5T560-520h240q17 0 28.5 11.5T840-480v320q0 17-11.5 28.5T800-120H560q-17 0-28.5-11.5T520-160Zm-400 0v-160q0-17 11.5-28.5T160-360h240q17 0 28.5 11.5T440-320v160q0 17-11.5 28.5T400-120H160q-17 0-28.5-11.5T120-160Zm80-360h160v-240H200v240Zm400 320h160v-240H600v240Zm0-480h160v-80H600v80ZM200-200h160v-80H200v80Zm160-320Zm240-160Zm0 240ZM360-280Z"/></svg>
          <span>Dashboard</span>
        </a>
      </li>
      <li>
        <button onclick=toggleSubMenu(this) class="dropdown-btn">
          <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M160-160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h207q16 0 30.5 6t25.5 17l57 57h320q33 0 56.5 23.5T880-640v400q0 33-23.5 56.5T800-160H160Zm0-80h640v-400H447l-80-80H160v480Zm0 0v-480 480Zm400-160v40q0 17 11.5 28.5T600-320q17 0 28.5-11.5T640-360v-40h40q17 0 28.5-11.5T720-440q0-17-11.5-28.5T680-480h-40v-40q0-17-11.5-28.5T600-560q-17 0-28.5 11.5T560-520v40h-40q-17 0-28.5 11.5T480-440q0 17 11.5 28.5T520-400h40Z"/></svg>
          <span>File manage</span>
          <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M480-361q-8 0-15-2.5t-13-8.5L268-556q-11-11-11-28t11-28q11-11 28-11t28 11l156 156 156-156q11-11 28-11t28 11q11 11 11 28t-11 28L508-372q-6 6-13 8.5t-15 2.5Z"/></svg>
        </button>
        <ul class="sub-menu">
          <div>
            <li><a href="#">Folder</a></li>
          </div>
        </ul>
      </li>
      <li>
        <button onclick=toggleSubMenu(this) class="dropdown-btn">
          <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="m221-313 142-142q12-12 28-11.5t28 12.5q11 12 11 28t-11 28L250-228q-12 12-28 12t-28-12l-86-86q-11-11-11-28t11-28q11-11 28-11t28 11l57 57Zm0-320 142-142q12-12 28-11.5t28 12.5q11 12 11 28t-11 28L250-548q-12 12-28 12t-28-12l-86-86q-11-11-11-28t11-28q11-11 28-11t28 11l57 57Zm339 353q-17 0-28.5-11.5T520-320q0-17 11.5-28.5T560-360h280q17 0 28.5 11.5T880-320q0 17-11.5 28.5T840-280H560Zm0-320q-17 0-28.5-11.5T520-640q0-17 11.5-28.5T560-680h280q17 0 28.5 11.5T880-640q0 17-11.5 28.5T840-600H560Z"/></svg>
          <span>Management</span>
          <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M480-361q-8 0-15-2.5t-13-8.5L268-556q-11-11-11-28t11-28q11-11 28-11t28 11l156 156 156-156q11-11 28-11t28 11q11 11 11 28t-11 28L508-372q-6 6-13 8.5t-15 2.5Z"/></svg>
        </button>
        <ul class="sub-menu">
          <div>
            <li><a href="product.php">Add Category</a></li>
            <li><a href="add-product.php">Add Product</a></li>
          </div>
        </ul>
      </li>
    </ul>
  </nav>
  <main>
  <div class="container">
        <h2>Add a New Product</h2>
        
        <form action="process.php" method="post" enctype="multipart/form-data">
            <label for="category">Select Category Table:</label>
            <select name="category" id="category" required>
                <option value="">-- Select a Category --</option>
                <?php foreach ($tables as $table): ?>
                    <option value="<?= htmlspecialchars($table) ?>"><?= htmlspecialchars($table) ?></option>
                <?php endforeach; ?>
            </select>

            <label for="name">Product Name:</label>
            <input type="text" name="name" id="name" required>

            <label for="special_name">Special Name:</label>
            <input type="text" name="special_name" id="special_name" required>

            <label for="product_image">Product Image:</label>
            <input type="file" name="product_image" id="product_image" accept="image/*" required>

            <input type="submit" value="Submit">
        </form>
    </div>
  </main>
</body>
</html>