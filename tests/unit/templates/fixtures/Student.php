<?php
if (!function_exists('autoIncrementStudent')) {
    function autoIncrementStudent()
    {
        static $i;
        $i++;
        return $i;
    }
}

return [
    'id' => autoIncrementStudent(),
    'last_name' => $faker->lastName,
    'first_name' => $faker->firstName,
    'course_id' => $faker->numberBetween(1,5),
];