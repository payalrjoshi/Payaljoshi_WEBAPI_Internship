<?php
require 'vendor/autoload.php';  

use PhpOffice\PhpSpreadsheet\IOFactory;

$inputFileName = 'collegelist.xlsx';  

try {
    // Load the Excel file
    $spreadsheet = IOFactory::load($inputFileName);
    $sheet = $spreadsheet->getActiveSheet();
    $data = $sheet->toArray(); 

    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    foreach ($data as $row) {
        echo "<tr>";
        foreach ($row as $cell) {
            echo "<td>" . htmlspecialchars($cell) . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
} catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
    echo 'Error loading file: ', $e->getMessage();
}
?>