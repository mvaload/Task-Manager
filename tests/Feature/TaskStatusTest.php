<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\TaskStatus;

class TaskStatusTest extends TestCase
{
    public function testGetTaskStatusesIndex()
    {
        $user = $this->usersTestSet->first();
        $testStatus = $this->taskStatusesTestSet->first();
        $this->actingAs($user)
            ->get('/task_statuses')
            ->assertOk();
        $this->assertDatabaseHas('task_statuses', ['name' => $testStatus->name]);
    }
    
    public function testGetTaskStatusesCreate()
    {
        $user = $this->usersTestSet->first();
        $this->actingAs($user)->get('/task_statuses/create')->assertOk();
    }

    public function testPostTaskStatusesStore()
    {
        $user = $this->usersTestSet->first();
        $this->actingAs($user)
            ->from('/task_statuses/create')
            ->post('/task_statuses', ['name' => 'NewTaskStatus'])
            ->assertRedirect('/task_statuses');
        $this->assertDataBaseHas('task_statuses', ['name' => 'NewTaskStatus']);
    }

    public function testPostTaskStatusesStoreValidationFail()
    {
        $user = $this->usersTestSet->first();
        $this->actingAs($user)
            ->from('/task_statuses/create')
            ->post('/task_statuses', ['name' => null])
            ->assertRedirect('/task_statuses/create');
    }

    public function testGetTaskStatusesEdit()
    {
        $user = $this->usersTestSet->first();
        $testStatus = $this->taskStatusesTestSet->first();
        $this->actingAs($user)->get("/task_statuses/{$testStatus->id}/edit")->assertOk();
    }

    public function testPutTaskStatuses()
    {
        $user = $this->usersTestSet->first();
        $testStatus = $this->taskStatusesTestSet->first();

        $this->actingAs($user)
            ->from("/task_statuses/{$testStatus->id}/edit")
            ->put("/task_statuses/{$testStatus->id}", ['name' => 'UpdatedTaskStatus'])
            ->assertRedirect('/task_statuses');
        $this->assertDatabaseHas('task_statuses', ['name' => 'UpdatedTaskStatus']);
    }

    public function testPutTaskStatusesVakidationFail()
    {
        $user = $this->usersTestSet->first();
        $testStatus = $this->taskStatusesTestSet->first();

        $this->actingAs($user)
            ->from("/task_statuses/{$testStatus->id}/edit")
            ->put("/task_statuses/{$testStatus->id}", ['name' => null])
            ->assertRedirect("/task_statuses/{$testStatus->id}/edit");
    }

    public function testDeleteTaskStatuses()
    {
        $user = $this->usersTestSet->first();
        $testStatus = $this->taskStatusesTestSet->first();
        $this->actingAs($user)->delete("/task_statuses/{$testStatus->id}");
        $this->assertSoftDeleted('task_statuses', ['name' => $testStatus->name]);
    }
}
