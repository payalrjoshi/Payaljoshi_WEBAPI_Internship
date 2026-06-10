<?php
require 'vendor/autoload.php'; 

use PhpOffice\PhpSpreadsheet\IOFactory;

$host = "localhost";
$dbname = "2026";
$username = "root";
$password = "";

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$inputFileName = "collegelist.xlsx"; 
$spreadsheet = IOFactory::load($inputFileName);
$sheet = $spreadsheet->getActiveSheet();
$rows = $sheet->toArray();

array_shift($rows); // Skip header row

foreach ($rows as $row) {
    $enrollNumber = $conn->real_escape_string($row[0]);
    $name         = $conn->real_escape_string($row[1]);
    $faculty      = $conn->real_escape_string($row[2]);
    $college      = $conn->real_escape_string($row[3]);

    $sql = "INSERT INTO collegelist (enrollNumber, name, faculty, college) 
            VALUES ('$enrollNumber', '$name', '$faculty', '$college')
            ON DUPLICATE KEY UPDATE
            name='$name', faculty='$faculty', college='$college'";
    
    $conn->query($sql);
}

$conn->close();

echo "Excel data imported successfully.";
?>