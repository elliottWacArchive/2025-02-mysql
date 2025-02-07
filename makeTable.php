<?php

function makeTables($titles, $content, $column, $line)
{   
    $columnMax = [];
    for($i = 0; $i < $column; $i++) {
        foreach($content[$i] as $line) {
            if (strlen($line) > $columnMax[$i]) {
                $columnMax[$i] = strlen($line);
            }
        }
        if (strlen($title[$i]) > $columnMax[$i]) {
            $columnMax[$i] = strlen($title[$i]);
        }
    }
}