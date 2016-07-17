<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Entry::class, function ($faker) {
    $destination = ['africa', 'europe', 'usa', 'australia', 'asia', 'central'];
    $movie = ['indiana', '50first', 'eatpray', 'roman'];
    $item = ['swim', 'cam', 'boot', 'hat'];
    $todo = ['scuba', 'sunsrise', 'paragl', '4x4'];
    $duration = ['2weeks', '4weeks', '3months', '6months'];
    return [
        'destination' => $faker->randomElement($destination),
        'movie' => $faker->randomElement($movie),
        'item' => $faker->randomElement($item),
        'todo' => $faker->randomElement($todo),
        'duration' => $faker->randomElement($duration),
    ];
});
