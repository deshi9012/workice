<?php

namespace Tests\Endpoints;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Notification;
use Modules\Clients\Entities\Client;
use Modules\Deals\Entities\Deal;
use Modules\Users\Entities\User;
use Tests\TestCase;
use Tests\Traits\InteractsWithPassport;

class TodoTest extends TestCase
{
    use DatabaseTransactions, InteractsWithPassport;

    protected function setUp()
    {
        parent::setUp();
        Notification::fake();
    }

    public function test_view_without_authentication()
    {
        $response = $this->getJson('/api/v1/todos')->assertStatus(401);
    }

    public function test_create_without_authentication()
    {
        $response = $this->postJson('/api/v1/todos', [])->assertStatus(401);
    }

    public function test_delete_without_authentication()
    {
        $this->deleteJson('/api/v1/todos/12345')->assertStatus(401);
    }

    public function test_crud_todos()
    {
        $this->createUserWithToken();
        $deal               = factory(Deal::class)->make();
        $deal->organization = factory(Client::class)->create()->id;
        $deal->user_id      = User::latest()->first()->id;
        $deal->save();
        $payload = [
            'module'    => 'deals',
            'module_id' => $deal->id,
            'subject'   => 'Test Deal activity',
            'due_date'  => now()->addDays(7)->toDateTimeString(),
        ];

        $response = $this->postJson('/api/v1/todos', $payload);
        $response->assertStatus(201)->assertJson([
            'id' => true,
        ]);
        $todo     = $response->getData()->id;
        $response = $this->getJson('/api/v1/todos/' . $todo);
        $response->assertStatus(200)->assertJson([
            'id' => true,
        ]);
        $response = $this->putJson('/api/v1/todos/' . $todo, array_prepend($payload, 1, 'assignee'));
        $response->assertStatus(200)->assertJson([
            'id' => true,
        ]);
        $response = $this->getJson('/api/v1/todos');
        $response->assertStatus(200)->assertJson([
            'data' => true,
        ]);
        $response = $this->deleteJson('/api/v1/todos/' . $todo);
        $response->assertStatus(200)->assertJson([
            'message' => true,
        ]);
    }

    public function test_get_undefined_todo()
    {
        $this->createUserWithToken();
        $this->getJson('/api/v1/todos/13232323')->assertStatus(404);
    }

    public function test_create_without_payload()
    {
        $this->createUserWithToken();
        $this->postJson('/api/v1/todos', [])->assertStatus(422);
    }

    public function test_delete_undefined_todo()
    {
        $this->createUserWithToken();
        $this->deleteJson('/api/v1/todos/13232323')->assertStatus(404);
    }
}
