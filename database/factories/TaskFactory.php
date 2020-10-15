<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
use App\TaskStatus;
use App\User;
use App\Task;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word,
        'description' => $faker->text,
        'status_id' => factory(TaskStatus::class)->create()->id,
        'creator_id' => factory(User::class)->create()->id,
        'assigned_to_id' => factory(User::class)->create()->id
    ];
});
