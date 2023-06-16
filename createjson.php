<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $inputJSON = file_get_contents('php://input');
    $data = json_decode($inputJSON);
    $json = json_encode($data, JSON_PRETTY_PRINT);
    $file = 'users.json';

    if (file_put_contents($file, $json)) {
        echo "JSON file created successfully";
    } else {
        echo "Error creating JSON file";
    }
}