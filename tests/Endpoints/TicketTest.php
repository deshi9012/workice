<?php

namespace Tests\Endpoints;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Notification;
use Modules\Users\Entities\User;
use Tests\TestCase;
use Tests\Traits\InteractsWithPassport;

class TicketTest extends TestCase
{
    use DatabaseTransactions, InteractsWithPassport;

    protected function setUp()
    {
        parent::setUp();
        Notification::fake();
    }

    public function test_view_without_authentication()
    {
        $response = $this->getJson('/api/v1/tickets')->assertStatus(401);
    }

    public function test_create_without_authentication()
    {
        $response = $this->postJson('/api/v1/tickets', [])->assertStatus(401);
    }

    public function test_delete_without_authentication()
    {
        $this->deleteJson('/api/v1/tickets/12345')->assertStatus(401);
    }

    public function test_crud_operations()
    {
        $this->createUserWithToken();
        $user_id = $this->user->id;
        $payload = [
            'department' => 1,
            'subject'    => 'Test Ticket',
            'body'       => 'Test ticket issue',
            'priority'   => 3,
            'user_id'    => $user_id,
            'assignee'   => $user_id,
        ];

        $response = $this->postJson('/api/v1/tickets', $payload);
        $response->assertStatus(201)->assertJson([
            'id' => true,
        ]);
        $ticket   = $response->getData()->id;
        $response = $this->getJson('/api/v1/tickets/' . $ticket);
        $response->assertStatus(200)->assertJson([
            'id' => true,
        ]);
        $response = $this->putJson('/api/v1/tickets/' . $ticket, array_prepend($payload, 1, 'assignee'));
        $response->assertStatus(200)->assertJson([
            'id' => true,
        ]);
        $response = $this->getJson('/api/v1/tickets');
        $response->assertStatus(200)->assertJson([
            'data' => true,
        ]);
        $response = $this->deleteJson('/api/v1/tickets/' . $ticket);
        $response->assertStatus(200)->assertJson([
            'message' => true,
        ]);
    }

    public function test_get_undefined_ticket()
    {
        $this->createUserWithToken();
        $this->getJson('/api/v1/tickets/13232323')->assertStatus(404);
    }

    public function test_create_without_payload()
    {
        $this->createUserWithToken();
        $this->postJson('/api/v1/tickets', [])->assertStatus(422);
    }

    public function test_delete_undefined_ticket()
    {
        $this->createUserWithToken();
        $this->deleteJson('/api/v1/tickets/13232323')->assertStatus(404);
    }
}
