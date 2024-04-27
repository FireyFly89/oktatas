<?php
$data = file_get_contents('data.txt');

if (empty($data)) {
    echo "Data was empty!";
    exit;
}

$dataArray = explode("\n", $data);
$columnNames = [];
$sortedArray = [];

foreach ($dataArray as $rowKey => $row) {
    $dataRow = explode('|', $row);
    
    if (count($dataRow) <= 1) {
        continue;
    }
    
    if ($rowKey === 1) {
        $columnNames = $dataRow;
        continue;
    }

    $dataRow = array_filter($dataRow);
    
    foreach ($dataRow as $columnKey => $column) {
        $columnName = trim($columnNames[$columnKey]);
        $sortedArray[$rowKey][$columnName] = trim($column);
    }

    echo '"' . implode('","', $sortedArray[$rowKey]) . "\"<br/>";
}

function dump($data, $die = false) {
    echo "<pre>";
    var_dump($data);
    echo "</pre>";

    if ($die) {
        die();
    }
}