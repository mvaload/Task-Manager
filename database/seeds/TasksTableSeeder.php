<?php

use Illuminate\Database\Seeder;
use App\User;
use App\TaskStatus;
use App\Task;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $taskStatuses = factory(TaskStatus::class, 2)->create();
        $users = factory(User::class, 2)->create();
        factory(Task::class, 3)->create([
            'status_id' => $taskStatuses->first()->id,
            'creator_id' => $users->first()->id,
            'assigned_to_id' => $users->first()->id
        ]);
        factory(Task::class, 3)->create([
            'status_id' => $taskStatuses->first()->id,
            'creator_id' => $users->first()->id,
            'assigned_to_id' => $users->last()->id
        ]);
    }
}