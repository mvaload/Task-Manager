<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IndexTest extends TestCase
{
    public function testGetHome()
    {
        $this->get('/')->assertRedirect('/login');
    }

    public function testGetDashboard()
    {
        $user = $this->usersTestSet->first();
        $this->actingAs($user)->get('/')->assertOk();
    }
}
