<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    public function testGetTasksIndex()
    {
        $user = $this->usersTestSet->first();
        $testTask = $this->tasksTestSet[0];
        $this->actingAs($user)->get('/tasks')->assertOk();
        $this->assertDatabaseHas('tasks', ['name' => $testTask->name]);
    }

    public function testGetTasksIndexWithFilter()
    {
        $user = $this->usersTestSet->first();
        $testStatus = $this->taskStatusesTestSet->first();
        $this->actingAs($user)->get("/tasks?filter[status_id]={$testStatus->id}")->assertOk();
    }

    public function testGetTasksCreate()
    {
        $user = $this->usersTestSet->first();
        $this->actingAs($user)->get('/tasks/create')->assertOk();
    }

    public function testPostTasksStore()
    {
        $user = $this->usersTestSet->first();
        $testStatus = $this->taskStatusesTestSet->first();
        $coworker = $this->usersTestSet->last();

        $this->actingAs($user)
            ->from('/tasks/create')
            ->post('/tasks', [
                'name' => 'NewTask',
                'description' => 'Some text description...',
                'status_id' => $testStatus->id,
                'creator_id' => $user->id,
                'tags' => 'tag1, tag2',
                'assigned_to_id' => $coworker->id
            ])->assertRedirect('/tasks');
        $this->assertDataBaseHas('tasks', ['name' => 'NewTask']);
        $this->assertDataBaseHas('tags', ['name' => 'tag1']);
    }

    public function testPostTasksStoreValidationFail()
    {
        $user = $this->usersTestSet->first();
        $testStatus = $this->taskStatusesTestSet->first();
        $coworker = $this->usersTestSet->last();

        $this->actingAs($user)
            ->from('/tasks/create')
            ->post('/tasks', [
                'name' => null,
                'description' => 'Some text description...',
                'status_id' => $testStatus->id,
                'creator_id' => $user->id,
                'assigned_to_id' => $coworker->id
            ])->assertRedirect('/tasks/create');
    }

    public function testGetTasksEdit()
    {
        $user = $this->usersTestSet->first();
        $testTask = $this->tasksTestSet[0];
        $this->actingAs($user)->get("/tasks/{$testTask->id}/edit")->assertOk();
    }

    public function testPutTasks()
    {
        $user = $this->usersTestSet->first();
        $testTask = $this->tasksTestSet[0];
        $testStatus = $this->taskStatusesTestSet->first();
        $coworker = $this->usersTestSet->last();

        $this->actingAs($user)
            ->from("/tasks/{$testTask->id}/edit")
            ->put("/tasks/{$testTask->id}", [
                'name' => 'UpdatedTaskName',
                'description' => 'Updated Text Descriptio...',
                'status_id' => $testStatus->id,
                'tags' => 'tag3',
                'creator_id' => $user->id,
                'assigned_to_id' => $coworker->id
            ])->assertRedirect('/tasks');
        $this->assertDatabaseHas('tasks', ['name' => 'UpdatedTaskName']);
        $this->assertDataBaseHas('tags', ['name' => 'tag3']);
    }

    public function testPutTasksValidationFail()
    {
        $user = $this->usersTestSet->first();
        $testTask = $this->tasksTestSet[0];
        $testStatus = $this->taskStatusesTestSet->first();
        $coworker = $this->usersTestSet->last();
        $this->actingAs($user)
            ->from("/tasks/{$testTask->id}/edit")
            ->put("/tasks/{$testTask->id}", [
                'name' => null,
                'description' => 'Updated Text Description...',
                'status_id' => $testStatus->id,
                'creator_id' => $user->id,
                'assigned_to_id' => $coworker->id
            ])->assertRedirect("/tasks/{$testTask->id}/edit");
    }

    public function testDeleteTasks()
    {
        $user = $this->usersTestSet->first();
        $testTask = $this->tasksTestSet[0];
        $this->actingAs($user)->delete("/tasks/{$testTask->id}");
        $this->assertDatabaseMissing('tasks', ['name' => $testTask->name]);
    }
}
