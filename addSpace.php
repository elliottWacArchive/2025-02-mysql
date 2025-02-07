<?php

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
