<?php
$imagePath = __DIR__ . "/super-admin/sidebar-menu/uploads/1742236803_OACOT4020-GRAY-1-300x300.jpg";

if (file_exists($imagePath)) {
    echo "Image exists!";
} else {
    echo "Image NOT found!";
}
?>
