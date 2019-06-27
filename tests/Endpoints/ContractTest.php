<?php

namespace Tests\Endpoints;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Modules\Clients\Entities\Client;
use Tests\TestCase;
use Tests\Traits\InteractsWithPassport;

class ContractTest extends TestCase
{
    use DatabaseTransactions, WithFaker, InteractsWithPassport;

    protected function setUp()
    {
        parent::setUp();
        Notification::fake();
    }

    public function test_view_without_authentication()
    {
        $response = $this->getJson('/api/v1/contracts')->assertStatus(401);
    }

    public function test_create_without_authentication()
    {
        $response = $this->postJson('/api/v1/contracts', [])->assertStatus(401);
    }

    public function test_delete_without_authentication()
    {
        $this->deleteJson('/api/v1/contracts/12345')->assertStatus(401);
    }

    public function test_crud_operations()
    {
        $client_id = factory(Client::class)->create()->id;
        $payload   = [
            'contract_title'     => 'Test Contract',
            'client_id'          => $client_id,
            'start_date'         => now()->toDateTimeString(),
            'end_date'           => now()->addDays(4)->toDateTimeString(),
            'expiry_date'        => 30,
            'currency'           => 'USD',
            'payment_terms'      => 14,
            'termination_notice' => 14,
        ];
        $this->createUserWithToken();
        $response = $this->postJson('/api/v1/contracts', $payload);
        $response->assertStatus(201)->assertJson([
            'id' => true,
        ]);
        $contract = $response->getData()->id;
        $response = $this->getJson('/api/v1/contracts/' . $contract);
        $response->assertStatus(200)->assertJson([
            'id' => true,
        ]);
        $response = $this->putJson('/api/v1/contracts/' . $contract, array_prepend($payload, '20', 'cancelation_fee'));
        $response->assertStatus(200)->assertJson([
            'id' => true,
        ]);
        $response = $this->getJson('/api/v1/contracts');
        $response->assertStatus(200)->assertJson([
            'data' => true,
        ]);
        $response = $this->deleteJson('/api/v1/contracts/' . $contract);
        $response->assertStatus(200)->assertJson([
            'message' => true,
        ]);
    }
    public function test_get_undefined_contract()
    {
        $this->createUserWithToken();
        $this->getJson('/api/v1/contracts/13232323')->assertStatus(404);
    }

    public function test_create_without_payload()
    {
        $this->createUserWithToken();
        $this->postJson('/api/v1/contracts', [])->assertStatus(422);
    }

    public function test_delete_undefined_contract()
    {
        $this->createUserWithToken();
        $this->deleteJson('/api/v1/contracts/13232323')->assertStatus(404);
    }
}
