<?php

function command($input)
{
    global $conn;
    $sql = $input;
    try {
        $meta = $conn->query($sql);
        $stmt = $conn->prepare($sql);
        $meta = $meta->getColumnMeta(0);
        $stmt->execute();
        $res = $stmt->fetchAll();
        $columnCount = $stmt->columnCount();
        $rowCount = $stmt->rowCount();
    } catch (PDOException $e) {
        echo "PDO : Connection failed: " . $e->getMessage() . "\n";
    }

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
    makeTables($title, $elements, $columnCount, $rowCount);
}
