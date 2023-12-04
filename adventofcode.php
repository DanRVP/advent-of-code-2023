<?php

define('ROOT', dirname(__FILE__));
define('DAYS', ROOT . '\days');
define('DATA', ROOT . '\data');

$files = array_diff(scandir(DAYS), ['..', '.']); ;
foreach ($files as $file) {
    require_once DAYS . "\\$file";
}

$funcs = get_defined_functions(true);
foreach ($funcs['user'] as $func) {
    if (preg_match('/day_[0-9]+_part_[0-9]+/', $func)) {
        $func_name = implode(' ', array_map('ucfirst', explode('_', $func)));
        echo "$func_name: " .  call_user_func($func) . "\n";
    }
}
