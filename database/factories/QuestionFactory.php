<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Question;
use Faker\Generator as Faker;

$factory->define(Question::class, function (Faker $faker) {
    // suprimiendo el punto en todos los textos para título
    // paragraphs => separa con saltos de línea aleatorias
    return [
        'title'   => rtrim($faker->sentence(rand(5, 10)), "."),
        'body'    => $faker->paragraphs(rand(3, 7), true),
        'views'   => rand(0, 10),
        'answers' => rand(0, 10),
        'votes' => rand(-3 , 10),
    ];
});
