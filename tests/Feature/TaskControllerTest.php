<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Task;
use App\TaskStatus;
use App\User;
use App\Tag;

class TaskControllerTest extends TestCase
{
    public function setUp(): void
    {

        parent::setUp();

        $this->withoutExceptionHandling();
        $this->user = factory(User::class)->create();
        $this->tag = factory(Tag::class)->create();
        $this->task = factory(Task::class)->create(['creator_id' => $this->user->id]);
        $this->task->tags()->attach($this->tag->id);
        $this->actingAs($this->user);
    }

    public function testIndex()
    {
        $response = $this->get(route('tasks.index'));
        $response->assertStatus(200);
        $response->assertSeeTextInOrder(Task::pluck('name', 'id')->all());
    }

    public function testCreate()
    {
        $response = $this->get(route('tasks.create'));
        $response->assertStatus(200);
        $response->assertSeeInOrder(User::pluck('name')->all());
        $response->assertSeeInOrder(TaskStatus::pluck('name')->all());
    }

    public function testStore()
    {
        $factoryData = factory(Task::class)->make()->toArray();
        $data = \Arr::only(
            $factoryData,
            ['name', 'description', 'status_id', 'assigned_to_id']
        );
        $response = $this->actingAs($this->user)
            ->post(route('tasks.store'), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('tasks', $data);
    }

    public function testShow()
    {
        $response = $this->get(route('tasks.show', $this->task));
        $response->assertStatus(200);
        $response->assertSeeTextInOrder($this->task->pluck('name', 'description')->all());
    }

    public function testEdit()
    {
        $response = $this->get(route('tasks.edit', $this->task));
        $response->assertOk();
        $response->assertSee($this->task->name);
    }

    public function testUpdate()
    {
        $task = factory(Task::class)->create();
        $factoryData = factory(Task::class)->make()->toArray();
        $data = \Arr::only(
            $factoryData,
            ['name', 'description', 'status_id']
        );
        $response = $this->actingAs($task->creator)
            ->patch(route('tasks.update', $task), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('tasks', $data);
    }

    public function testDestroy()
    {
        $response = $this->delete(route('tasks.destroy', $this->task));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('tasks.index'));

        $this->assertDatabaseMissing('tasks', ['id' => $this->task->id]);
    }
}
