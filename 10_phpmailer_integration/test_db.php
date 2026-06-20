<?php
$c = mysqli_connect('localhost', 'root', '', 'exceldemo');
mysqli_query($c, 'ALTER TABLE students ADD COLUMN password VARCHAR(255) DEFAULT NULL');
echo "Table altered.";
?>
