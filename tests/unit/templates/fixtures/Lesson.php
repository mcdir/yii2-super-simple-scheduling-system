<?php

if (!function_exists('autoIncrementLesson')) {
    function autoIncrementLesson()
    {
        static $i;
        $i++;
        return $i;
    }
}

return [
    'lesson_id' => autoIncrementLesson(),
    'title_about' => $faker->company,
];
