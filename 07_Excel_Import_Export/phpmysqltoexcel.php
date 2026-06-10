<?php
require 'vendor/autoload.php'; 

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// DB config
$host = "localhost";
$dbname = "pdfdemo";
$username = "root";
$password = "";

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT rno, rdate, stud_id, stud_nm, ccode, cname, amt, pay_method FROM receipt";
$result = $conn->query($sql);

// Create spreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Column headings
$headers = ['rno', 'rdate', 'stud_id', 'stud_nm', 'ccode', 'cname', 'amt', 'pay_method'];
$col = 'A';
foreach ($headers as $header) {
    $sheet->setCellValue($col . '1', $header);
    $col++;
}

// Fill data
$rowNumber = 2;
while ($row = $result->fetch_assoc()) {
    $col = 'A';
    foreach ($headers as $field) {
        $sheet->setCellValue($col . $rowNumber, $row[$field]);
        $col++;
    }
    $rowNumber++;
}

// Save to file
$filename = 'mad_receipt_export.xlsx';
$writer = new Xlsx($spreadsheet);
$writer->save($filename);

echo "Exported successfully: <a href='$filename' download>Download Excel</a>";
?>