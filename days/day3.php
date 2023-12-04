<?php

/**
 * IDK
 *
 * @return int
 */
function day_3_part_1(): int
{
    $contents = file_get_contents(DATA . '\day3-input.txt', 'r');
    $result = 0;

    preg_match_all('/[^\s\d\w.]/', $contents, $matches);
    $valid_symbols = array_unique($matches[0]);

    foreach (explode("\n", $contents) as $line) {
        $lines[] = str_split(trim($line));
    }

    foreach ($lines as $chars) {
        for ($i = 0; $i < count($chars); $i++) {
            // if () {}
        }
    }

    return $result;
}

/**
 * Who knows
 *
 * @return int
 */
function day_3_part_2(): int
{
    return 0;
}
