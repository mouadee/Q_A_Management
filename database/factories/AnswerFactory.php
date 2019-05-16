<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Answer;
use App\Model;
use App\User;
use Faker\Generator as Faker;

$factory->define(Answer::class, function (Faker $faker) {
    return [
        'body' => $faker->paragraph(rand(3, 7), true),
        'user_id' => User::pluck('id')->random(),
        'votes_count' => rand(0, 5),
        'question_id' => rand(0, 5)
    ];
});
