<?php

function command($input) {
    global $conn;
    $sql = $input;
    $meta = $conn->query($sql);
    $stmt = $conn->prepare($sql);
    $meta = $meta->getColumnMeta(0);
    $stmt->execute();
    $res = $stmt->fetchAll();
    $columnCount = $stmt->columnCount();
    $rowCount = $stmt->rowCount();

    $title = [];
    $elements = [];

    for ($i = 0; $i < $columnCount; $i++) {
        $meta = $conn->query($sql);
        $meta = $meta->getColumnMeta($i);
        array_push($title, $meta['name']);
        $tab = [];
        for ($j = 0; $j < $rowCount; $j++) {
            array_push($tab, $res[$j][$meta['name']]);
        }
        $elements[$i] = $tab;
    }
    // var_dump($elements);
    makeTables($title, $elements, $columnCount, $rowCount);
}

function makeTables($titles, $content, $column, $line)
{   
    $columnMax = [];
    $outputLen = 2;
    for($i = 0; $i < $column; $i++) {
        foreach($content[$i] as $lin) {
            if (!isset($columnMax[$i]) || mb_strlen($lin, 'UTF-8') > $columnMax[$i]) {
                $columnMax[$i] = strlen($lin);
            }
        }
        if (!isset($columnMax[$i]) || mb_strlen($titles[$i], 'UTF-8') > $columnMax[$i]) {
            $columnMax[$i] = mb_strlen($titles[$i], 'UTF-8');
        }
    }
    foreach ($columnMax as $val) {
        $outputLen += $val;
    }
    foreach ($columnMax as $key => $size) {
        echo "+" . str_repeat("-", $size + 2);
    }
    echo "+\n| ";
    foreach ($titles as $n => $title) {
        addSpace($title ,$columnMax[$n]);
        echo " | ";
    }
    echo "\n";
    foreach ($columnMax as $key => $size) {
        echo "+" . str_repeat("-", $size + 2);
    }
    echo "+\n";
    // echo $line . " " . $column;
    for ($i = 0; $i < count($content[0]); $i++) {
        echo "| ";
        for ($j = 0; $j < $column; $j++) {
            addSpace($content[$j][$i], $columnMax[$j]);
            echo " | ";
        }
        echo "\n";
    }
    foreach ($columnMax as $key => $size) {
        echo "+" . str_repeat("-", $size + 2);
    }
    echo "+\n";
}

function addSpace($text, $size) {
    $text = strval($text);
    $text = trim($text);
    $gap = $size - mb_strlen($text, 'UTF-8');
    if ($gap == 0) {
        echo $text;
    } else {
        echo $text . str_repeat(" ", $gap);
    }
}