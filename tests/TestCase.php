<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\User;
use App\TaskStatus;
use App\Tag;
use App\Task;

class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    protected $usersTestSet;
    protected $tagsTestSet;
    protected $taskStatusesTestSet;
    protected $tasksTestSet;

    public function setUp(): void
    {
        parent::setUp();

        $this->usersTestSet = factory(User::class, 2)->create();
        $this->taskStatusesTestSet = factory(TaskStatus::class, 2)->create();
        $this->tagsTestSet = factory(Tag::class, 3)->create();
        $testStatus = $this->taskStatusesTestSet->first();
        $creator = $this->usersTestSet->first();
        $coworker = $this->usersTestSet->last();
        $this->tasksTestSet[] = factory(Task::class)->create([
            'status_id' => $testStatus->id,
            'creator_id' => $creator->id,
            'assigned_to_id' => $creator->id
        ]);
        $this->tasksTestSet[] = factory(Task::class)->create([
            'status_id' => $testStatus->id,
            'creator_id' => $creator->id,
            'assigned_to_id' => $coworker->id
        ]);
        $taskWithTags = $this->tasksTestSet[0];
        $tags = $this->tagsTestSet->map(function ($tag, $key) {
            return $tag->id;
        })->toArray();
        $taskWithTags->tags()->sync($tags);
        $taskWithTags->save();
    }
}
