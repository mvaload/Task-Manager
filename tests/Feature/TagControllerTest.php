<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Tag;

class TagControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->tag = factory(Tag::class)->create();
    }

    public function testIndex()
    {
        $response = $this->get(route('tags.index'));
        $response->assertStatus(200);
        $response->assertSeeTextInOrder(Tag::pluck('name', 'id')->all());
    }

    public function testCreate()
    {
        $response = $this->get(route('tags.create'));
        $response->assertOk();
    }

    public function testEdit()
    {
        $response = $this->get(route('tags.edit', $this->tag));
        $response->assertOk();
        $response->assertSee($this->tag->name);
    }

    public function testStore()
    {
        $tag = factory(Tag::class)->make();
        $name = $tag->name;
        $response = $this->post(route('tags.store'), compact('name'));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('tags', compact('name'));
    }

    public function testUpdate()
    {
        $tag = factory(Tag::class)->make();
        $name = $tag->name;
        $response = $this->patch(route('tags.update', $this->tag), compact('name'));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('tags', compact('name'));
    }

    public function testDestroy()
    {
        $response = $this->delete(route('tags.destroy', $this->tag));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseMissing('tags', ['id' => $this->tag->id, 'name' => $this->tag->name]);
    }
}
