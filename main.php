<?php

require 'includes.php';

while (true) {
    echo mb_strlen("49 Rue du Général de Gaulle", 'UTF-8');
    echo "mysql> ";
    $var = trim(fgets(STDIN));
    command($var);
}