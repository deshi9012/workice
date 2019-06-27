<?php

namespace Tests\Endpoints;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Notification;
use Modules\Clients\Entities\Client;
use Tests\TestCase;
use Tests\Traits\InteractsWithPassport;

class EstimateTest extends TestCase
{
    use DatabaseTransactions, InteractsWithPassport;

    protected function setUp()
    {
        parent::setUp();
        Notification::fake();
    }

    public function test_view_without_authentication()
    {
        $response = $this->getJson('/api/v1/estimates')->assertStatus(401);
    }

    public function test_create_without_authentication()
    {
        $response = $this->postJson('/api/v1/estimates', [])->assertStatus(401);
    }

    public function test_delete_without_authentication()
    {
        $this->deleteJson('/api/v1/estimates/12345')->assertStatus(401);
    }

    public function test_crud_operations()
    {
        $this->createUserWithToken();
        $client_id = factory(Client::class)->create()->id;
        $payload   = [
            'reference_no' => generateCode('estimates'),
            'client_id'    => $client_id,
            'currency'     => 'USD',
            'due_date'     => now()->addDays(14)->toDateTimeString(),
        ];

        $response = $this->postJson('/api/v1/estimates', $payload);
        $response->assertStatus(201)->assertJson([
            'id' => true,
        ]);
        $estimate = $response->getData()->id;
        $response = $this->getJson('/api/v1/estimates/' . $estimate);
        $response->assertStatus(200)->assertJson([
            'id' => true,
        ]);
        $response = $this->putJson('/api/v1/estimates/' . $estimate, array_prepend($payload, '6', 'tax'));
        $response->assertStatus(200)->assertJson([
            'id' => true,
        ]);
        $response = $this->getJson('/api/v1/estimates');
        $response->assertStatus(200)->assertJson([
            'data' => true,
        ]);
        $response = $this->deleteJson('/api/v1/estimates/' . $estimate);
        $response->assertStatus(200)->assertJson([
            'message' => true,
        ]);
    }

    public function test_get_undefined_estimate()
    {
        $this->createUserWithToken();
        $this->getJson('/api/v1/estimates/13232323')->assertStatus(404);
    }

    public function test_create_without_payload()
    {
        $this->createUserWithToken();
        $this->postJson('/api/v1/estimates', [])->assertStatus(422);
    }

    public function test_delete_undefined_estimate()
    {
        $this->createUserWithToken();
        $this->deleteJson('/api/v1/estimates/13232323')->assertStatus(404);
    }
}
