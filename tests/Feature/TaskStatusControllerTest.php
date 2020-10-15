<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use App\TaskStatus;

class TaskStatusControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
        $this->task_status = TaskStatus::first();
        $this->user = factory(User::class)->create();
        $this->actingAs($this->user);
    }

    public function testIndex()
    {
        $response = $this->get(route('task_statuses.index'));
        $response->assertOk();
        $response->assertSeeInOrder(__('models.taskStatus'));
        $response->assertSeeTextInOrder(TaskStatus::pluck('name')->all());
    }

    public function testCreate()
    {
        $response = $this->get(route('task_statuses.create'));
        $response->assertOk();
    }

    public function testEdit()
    {
        $response = $this->get(route('task_statuses.edit', $this->task_status));
        $response->assertOk();
        $response->assertSee($this->task_status->name);
    }

    public function testStore()
    {
        $newTaskStatus = factory(TaskStatus::class)->make();
        $name = $newTaskStatus->name;
        $response = $this->post(route('task_statuses.store'), compact('name'));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('task_statuses', compact('name'));
    }

    public function testUpdate()
    {
        $task = factory(TaskStatus::class)->create();
        $factoryData = factory(TaskStatus::class)->make()->toArray();
        $data = ['name' => $factoryData['name']];
        $response = $this->actingAs($this->user)
            ->patch(route('task_statuses.update', $task), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('task_statuses', $data);
    }

    public function testDestroy()
    {
        $response = $this->delete(route('task_statuses.destroy', $this->task_status));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertSoftDeleted('task_statuses', ['id' => $this->task_status->id]);
    }
}
