<?php

use Illuminate\Database\Seeder;
use App\TaskStatus;

class TaskStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect(['new', 'in work', 'on testing', 'completed'])
            ->each(fn ($status) => TaskStatus::create(['name' => $status]));
    }
}
