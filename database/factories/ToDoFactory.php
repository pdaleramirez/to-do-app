<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model\ToDo;
use Faker\Generator as Faker;

$factory->define(ToDo::class, function (Faker $faker) {
    return [
        'description' => $faker->sentence,
        'completed' => false
    ];
});
