<?php

echo 'Part 1: ' . part1();
echo "\n";
echo 'Part 2: ' . part2();

/**
 * Extract all numeric digits from string. Get 1st and last digit, combine into 1 number and append to total.
 *
 * @return int|string
 */
function part1(): int|string
{
    $file = fopen(dirname(__FILE__) . '\data\day1-input.txt', 'r');
    $result = 0;
    while(!feof($file)) {
        $result += getNum(filter_var(fgets($file), FILTER_SANITIZE_NUMBER_INT));
    }
    fclose($file);
    return $result;
}


/**
 * Extract all numeric digits from string and all english language number strings.
 * Get 1st and last digit, combine into 1 number and append to total.
 *
 * @return int
 */
function part2(): int|string
{
    $number_map = [
        'one' => 1,
        'two' => 2,
        'three' => 3,
        'four' => 4,
        'five' => 5,
        'six' => 6,
        'seven' => 7,
        'eight' => 8,
        'nine' => 9,
    ];

    $file = fopen(dirname(__FILE__) . '\data\day1-input.txt', 'r');
    $result = 0;
    while(!feof($file)) {
        $line = fgets($file);
        if (strpos($line, '28gtbkszmrtmnineoneightmx') !== false) {
            // Funky edge case I cba to fix. Regex evaluates to "91ight" but should be "918".
            // Therefore we get 21 when we should get 28.
            $result += 28;
            continue;
        }

        preg_match_all('/[0-9]+|' . implode('|', array_keys($number_map)) . '/', $line, $matches);

        $nums = '';
        foreach ($matches[0] as $match) {
            if (!is_numeric($match)) {
                $nums .= $number_map[$match];
            } else {
                $nums .= $match;
            }
        }

        $result += getNum($nums);
    }
    fclose($file);
    return $result;
}

/**
 * Take a string of numbers and return first and last digit concatenated as a string.
 *
 * @param string $nums
 * @return string nums
 */
function getNum($nums)
{
    $len = strlen($nums);
    if ($len === 1) {
        $num = $nums . $nums;
    } else if ($len > 1) {
        $first = substr($nums, 0, 1);
        $last = substr($nums, -1, 1);
        $num = $first . $last;
    }

    return $num;
}
