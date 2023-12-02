<?php

echo 'Part 1: ' . part1();
echo "\n";
echo 'Part 2: ' . part2();

/**
 * Get the sum of the IDs of all possible games.
 *
 * @return int
 */
function part1(): int
{
    $file = fopen(dirname(__FILE__) . '\data\day2-input.txt', 'r');
    $result = 0;
    while(!feof($file)) {
        $res = isGamePossible(trim(fgets($file)));
        if ($res !== false) {
            $result += $res;
        }
    }
    fclose($file);
    return $result;
}

/**
 * Get the "power" (RxGxB) of each game's mininum number of cubes required to make the game possible.
 *
 * @return int
 */
function part2(): int
{
    $file = fopen(dirname(__FILE__) . '\data\day2-input.txt', 'r');
    $result = 0;
    while(!feof($file)) {
        $result += getGamePowers(trim(fgets($file)));
    }
    fclose($file);
    return $result;
}


/**
 * Check if a game is possible by adding all semi colon seperated values together
 */
function getGamePowers($line): int|bool
{
    [, $game_info] = explode(':', $line);
    $game_results = [
        'red' => [],
        'green' => [],
        'blue' => [],
    ];

    foreach (array_map('trim', explode(';', $game_info)) as $game_part) {
        foreach(array_map('trim', explode(',', $game_part)) as $part) {
            [$value, $key] = explode(' ', $part);
            $game_results[$key][] = $value;
        }
    }

    return array_product(array_map('max', $game_results));
}

/**
 * Check on each pull from the bag, the number of cubes for a certain colour is less
 * than or equal to the target number of cubes.
 *
 * @param string $line
 * @return int|bool
 */
function isGamePossible($line): int|bool
{
    $game_target = [
        'red' => 12,
        'green' => 13,
        'blue' => 14,
    ];

    [$game_id, $game_info] = explode(':', $line);
    $id = filter_var($game_id, FILTER_SANITIZE_NUMBER_INT);

    foreach (array_map('trim', explode(';', $game_info)) as $game_part) {
        foreach(array_map('trim', explode(',', $game_part)) as $part) {
            [$value, $key] = explode(' ', $part);
            if ($value > $game_target[$key]) {
                return false;
            }
        }
    }

    return $id;
}
