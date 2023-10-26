<?php

function csvToJson($csvFilePath) {
    $csvData = [];
    
    if (($handle = fopen($csvFilePath, 'r')) !== false) {
        while (($row = fgetcsv($handle)) !== false) {
            $csvData[] = $row;
        }
        fclose($handle);
    }

    // Assuming the first row of the CSV contains the column headers
    $headers = array_shift($csvData);

    $jsonArray = [];

    foreach ($csvData as $row) {
        $jsonArrayItem = [];
        foreach ($row as $i => $value) {
            $jsonArrayItem[$headers[$i]] = $value;
        }
        $jsonArray[] = $jsonArrayItem;
    }

    return json_encode($jsonArray);
}

$csvFilePath = 'datapribadi.csv'; // Ganti dengan jalur file lokal yang sesuai
$jsonData = csvToJson($csvFilePath);

// Set the content type to JSON
header('Content-Type: application/json');

// Output the JSON data
echo $jsonData;
?>
