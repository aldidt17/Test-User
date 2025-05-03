<?php
namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_be_added()
    {
        $response = $this->post('/users', [
            'name' => 'Nama 1',
            'email' => 'ke1@example.com',
            'age' => 19
        ]);

        $response->assertRedirect('/users');
        $this->assertDatabaseHas('users', ['email' => 'ke1@example.com']);
    }

    public function test_user_can_be_updated()
    {
        $user = User::create([
            'name' => 'old name',
            'email' => 'old@example.com',
            'age' => 10
        ]);
        
        $response = $this->put("/users/{$user->id}", [
            'name' => 'New Name',
            'email' => 'new@example.com',
            'age' => 19
        ]);

        $response->assertRedirect('/users');
        $this->assertDatabaseHas('users', ['email' => 'new@example.com']);
    }

    public function test_user_can_be_deleted()
    {
        $user = User::create([
            'name' => 'Delete Me',
            'email' => 'deleteme@example.com',
        ]);

        $response = $this->delete("/users/{$user->id}");

        $response->assertRedirect('/users');
        $this->assertDatabaseMissing('users', ['email' => 'deleteme@example.com']);
    }
}
