<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;
use App\Models\User;
use App\Models\Project;
use App\Models\Task;

class TaskTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_creating_task()
    {
        $user = User::create([
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        $this->actingAs($user);

        $response = $this->post('/projects', [
            'name' => 'ProjectX',
            'code' => 'PrX',
        ]);
        $response->assertStatus(200);

        $response = $this->post('/tasks', [
            'name' => 'Task1',
            'description' => 'Task 1 Description',
            'project_id' => $response['id']
        ]);
        $response->assertStatus(200);
    }
}
