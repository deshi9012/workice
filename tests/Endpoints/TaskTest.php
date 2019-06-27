<?php

namespace Tests\Endpoints;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Notification;
use Modules\Clients\Entities\Client;
use Modules\Projects\Entities\Project;
use Tests\TestCase;
use Tests\Traits\InteractsWithPassport;

class TaskTest extends TestCase
{
    use DatabaseTransactions, InteractsWithPassport;

    protected function setUp()
    {
        parent::setUp();
        Notification::fake();
    }

    public function test_view_without_authentication()
    {
        $response = $this->getJson('/api/v1/tasks')->assertStatus(401);
    }

    public function test_create_without_authentication()
    {
        $response = $this->postJson('/api/v1/tasks', [])->assertStatus(401);
    }

    public function test_delete_without_authentication()
    {
        $this->deleteJson('/api/v1/tasks/12345')->assertStatus(401);
    }

    public function test_crud_operations()
    {
        $project            = factory(Project::class)->make();
        $project->client_id = factory(Client::class)->create()->id;
        $project->save();
        $payload = [
            'name'            => 'Test Task',
            'project_id'      => $project->id,
            'progress'        => 50,
            'start_date'      => now()->toDateTimeString(),
            'due_date'        => now()->addDays(7)->toDateTimeString(),
            'estimated_hours' => 30,
        ];
        $this->createUserWithToken();
        $response = $this->postJson('/api/v1/tasks', $payload);
        $response->assertStatus(201)->assertJson([
            'id' => true,
        ]);
        $task     = $response->getData()->id;
        $response = $this->getJson('/api/v1/tasks/' . $task);
        $response->assertStatus(200)->assertJson([
            'id' => true,
        ]);
        $response = $this->putJson('/api/v1/tasks/' . $task, array_prepend($payload, 8, 'hourly_rate'));
        $response->assertStatus(200)->assertJson([
            'id' => true,
        ]);
        $response = $this->getJson('/api/v1/tasks');
        $response->assertStatus(200)->assertJson([
            'data' => true,
        ]);
        $response = $this->deleteJson('/api/v1/tasks/' . $task);
        $response->assertStatus(200)->assertJson([
            'message' => true,
        ]);
    }

    public function test_get_undefined_task()
    {
        $this->createUserWithToken();
        $this->getJson('/api/v1/tasks/13232323')->assertStatus(404);
    }

    public function test_create_without_payload()
    {
        $this->createUserWithToken();
        $this->postJson('/api/v1/tasks', [])->assertStatus(422);
    }

    public function test_delete_undefined_task()
    {
        $this->createUserWithToken();
        $this->deleteJson('/api/v1/tasks/13232323')->assertStatus(404);
    }
}
