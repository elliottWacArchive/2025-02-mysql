<?php

require 'includes.php';

while (true) {
    echo "mysql> ";
    $var = trim(fgets(STDIN));
    command($var);
}
