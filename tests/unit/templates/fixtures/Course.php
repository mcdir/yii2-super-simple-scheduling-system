<?php

if (!function_exists('autoIncrementCourse')) {
    function autoIncrementCourse()
    {
        static $i;
        $i++;
        return $i;
    }
}

return [
    'code' => autoIncrementCourse(),
    'title' => $faker->company,
    'description' => $faker->text(250),
];
