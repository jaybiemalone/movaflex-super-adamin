<?php
$imagePath = __DIR__ . "/super-admin/sidebar-menu/OACOT4020-BEIGE-1-300x300.jpg";

if (file_exists($imagePath)) {
    echo "Image exists!";
} else {
    echo "Image NOT found!";
}
?>
