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

use PageAnalyzer\Model\Domain;

$factory->define(
    Domain::class,
    static function (Faker\Generator $faker) {
        return [
            'name' => $faker->domainName,
            'created_at' => $faker->dateTime,
            'updated_at' => $faker->dateTime,
            'body' => $faker->randomHtml(),
            'code' => $faker->numberBetween(100, 600),
            'content_length' => $faker->randomNumber(),
        ];
    }
);
