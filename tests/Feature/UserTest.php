<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserTest extends TestCase
{
    public function testGetUsersIndex()
    {
        $user = $this->usersTestSet->first();
        $this->actingAs($user)->get('/users')->assertOk();
        $this->assertDatabaseHas('users', ['name' => $user->name]);
    }

    public function testGetUsersEdit()
    {
        $user = $this->usersTestSet->first();
        $this->actingAs($user)->get("/users/{$user->id}/edit")->assertOk();
    }

    public function testPutUsers()
    {
        $user = $this->usersTestSet->first();
        $this->actingAs($user)
            ->from("/users/{$user->id}/edit")
            ->put("/users/{$user->id}", ['name' => 'Rory Kilback', 'password' => null])
            ->assertRedirect('/');
        $this->assertDatabaseHas('users', ['name' => 'Rory Kilback']);
    }

    public function testPutUsersChangePassword()
    {
        $user = $this->usersTestSet->first();
        $this->actingAs($user)
            ->put("/users/{$user->id}", [
                'name' => 'Destini Schmitt',
                'password' => 'newpassword',
                'password_confirmation' => 'newpassword'
            ]);
        $this->assertDatabaseMissing('users', [
            'name' => $user->name,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
        ]);
    }

    public function testPutUsersValidationFail()
    {
        $user = $this->usersTestSet->first();
        $this->actingAs($user)
            ->from("/users/{$user->id}/edit")
            ->put("/users/{$user->id}", ['name' => null, 'password' => null])
            ->assertRedirect("/users/{$user->id}/edit");
    }

    public function testDeleteUsers()
    {
        $user = $this->usersTestSet->last();
        $this->actingAs($user)->delete("/users/{$user->id}");
        $this->assertSOftDeleted('users', ['name' => $user->name]);
    }
}
