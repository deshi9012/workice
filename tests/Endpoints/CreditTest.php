<?php

namespace Tests\Endpoints;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Notification;
use Modules\Clients\Entities\Client;
use Tests\TestCase;
use Tests\Traits\InteractsWithPassport;

class CreditTest extends TestCase
{
    use DatabaseTransactions, InteractsWithPassport;

    protected function setUp()
    {
        parent::setUp();
        Notification::fake();
    }

    public function test_view_without_authentication()
    {
        $response = $this->getJson('/api/v1/creditnotes')->assertStatus(401);
    }

    public function test_create_without_authentication()
    {
        $response = $this->postJson('/api/v1/creditnotes', [])->assertStatus(401);
    }

    public function test_delete_without_authentication()
    {
        $this->deleteJson('/api/v1/creditnotes/12345')->assertStatus(401);
    }

    public function test_crud_operations()
    {
        $client_id = factory(Client::class)->create()->id;
        $payload   = [
            'reference_no' => generateCode('credits'),
            'client_id'    => $client_id,
            'currency'     => 'USD',
        ];
        $this->createUserWithToken();
        $response = $this->postJson('/api/v1/creditnotes', $payload);
        $response->assertStatus(201)->assertJson([
            'id' => true,
        ]);
        $credit   = $response->getData()->id;
        $response = $this->getJson('/api/v1/creditnotes/' . $credit);
        $response->assertStatus(200)->assertJson([
            'id' => true,
        ]);
        $response = $this->putJson('/api/v1/creditnotes/' . $credit, array_prepend($payload, 'closed', 'status'));
        $response->assertStatus(200)->assertJson([
            'id' => true,
        ]);
        $response = $this->getJson('/api/v1/creditnotes');
        $response->assertStatus(200)->assertJson([
            'data' => true,
        ]);
        $response = $this->deleteJson('/api/v1/creditnotes/' . $credit);
        $response->assertStatus(200)->assertJson([
            'message' => true,
        ]);
    }

    public function test_get_undefined_credit()
    {
        $this->createUserWithToken();
        $this->getJson('/api/v1/creditnotes/13232323')->assertStatus(404);
    }

    public function test_create_without_payload()
    {
        $this->createUserWithToken();
        $this->postJson('/api/v1/creditnotes', [])->assertStatus(422);
    }

    public function test_delete_undefined_credit()
    {
        $this->createUserWithToken();
        $this->deleteJson('/api/v1/creditnotes/13232323')->assertStatus(404);
    }
}
