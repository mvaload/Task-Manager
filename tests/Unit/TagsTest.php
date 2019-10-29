<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Tag;
use App\Task;

class TagsTest extends TestCase
{
    public function testTagGetIds()
    {
        $tags = $this->tagsTestSet->map(function ($tag, $key) {
                return $tag->name;
        })->toArray();
        $tagsString = implode(', ', $tags);
        $expected = $this->tagsTestSet->map(function ($tag, $key) {
                return $tag->id;
        })->toArray();
        $this->assertEquals(Tag::getIds($tagsString), $expected);
    }

    public function testTagGetIdsEmpty()
    {
        $this->assertEquals(Tag::getIds(''), []);
    }
}
