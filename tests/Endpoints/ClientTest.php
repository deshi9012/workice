<?php

namespace Tests\Endpoints;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Notification;
use Modules\Clients\Entities\Client;
use Tests\TestCase;
use Tests\Traits\InteractsWithPassport;

class ClientTest extends TestCase
{
    use DatabaseTransactions, InteractsWithPassport;

    protected function setUp()
    {
        parent::setUp();
        Notification::fake();
    }

    public function test_view_without_authentication()
    {
        $response = $this->getJson('/api/v1/clients')->assertStatus(401);
    }

    public function test_create_without_authentication()
    {
        $response = $this->postJson('/api/v1/clients', [])->assertStatus(401);
    }

    public function test_delete_without_authentication()
    {
        $this->deleteJson('/api/v1/clients/12345')->assertStatus(401);
    }

    public function test_crud_operations()
    {
        $this->createUserWithToken();

        $client_id = factory(Client::class)->create()->id;
        $payload   = [
            'name'     => 'Safaricom',
            'email'    => 'test@company.com',
            'currency' => 'USD',
        ];

        $response = $this->postJson('/api/v1/clients', $payload);
        $response->assertStatus(201)->assertJson([
            'id' => true,
        ]);
        $client   = $response->getData()->id;
        $response = $this->getJson('/api/v1/clients/' . $client);
        $response->assertStatus(200)->assertJson([
            'id' => true,
        ]);
        $response = $this->putJson('/api/v1/clients/' . $client, array_prepend($payload, 1, 'owner'));
        $response->assertStatus(200)->assertJson([
            'id' => true,
        ]);
        $response = $this->getJson('/api/v1/clients');
        $response->assertStatus(200)->assertJson([
            'data' => true,
        ]);
        $response = $this->deleteJson('/api/v1/clients/' . $client);
        $response->assertStatus(200)->assertJson([
            'message' => true,
        ]);
    }

    public function test_get_undefined_client()
    {
        $this->createUserWithToken();
        $this->getJson('/api/v1/clients/13232323')->assertStatus(404);
    }

    public function test_create_without_payload()
    {
        $this->createUserWithToken();
        $this->postJson('/api/v1/clients', [])->assertStatus(422);
    }

    public function test_delete_undefined_client()
    {
        $this->createUserWithToken();
        $this->deleteJson('/api/v1/clients/13232323')->assertStatus(404);
    }
}
