<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
use App\TaskStatus;
use App\User;
use App\Task;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(6),
        'description' => $faker->text(),
        'status_id' => TaskStatus::make(['name' => 'FactoryTaskStatus'])->id,
        'creator_id' => factory(User::class)->make()->id,
        'assigned_to_id' => factory(User::class)->make()->id
    ];
});