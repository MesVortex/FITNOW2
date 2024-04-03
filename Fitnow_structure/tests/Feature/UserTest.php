<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_User_register(): void
    {
        $response = $this->post('/api/register',[
            'name' => 'mostafa',
            'email' => 'mo@gmail.com',
            'password' => '12345678',
            'password_confirmation' => '12345678',
        ]);

        $response->assertStatus(200);
    }

    public function test_User_login(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/api/login',[
            'email' => $user->email,
            'password' => '12345678',
        ]);

        $response->assertStatus(200);
    }

    public function test_User_logout(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->post('/api/logout');

        $response->assertStatus(200);
    }
}
