<?php

$conn = mysqli_connect(
    "localhost:3307",  "root", "", "php_rest_demo" );

header("Content-Type: application/json");

if (!$conn) {

    echo json_encode([
        "status" => false,
        "message" => "Database Connection Failed"
    ]);

    exit;
}

?>