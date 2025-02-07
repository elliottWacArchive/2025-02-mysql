<?php

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