<?php

namespace Tests\Endpoints;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Notification;
use Modules\Clients\Entities\Client;
use Tests\TestCase;
use Tests\Traits\InteractsWithPassport;

class InvoiceTest extends TestCase
{
    use DatabaseTransactions, InteractsWithPassport;

    protected function setUp()
    {
        parent::setUp();
        Notification::fake();
    }

    public function test_view_without_authentication()
    {
        $response = $this->getJson('/api/v1/invoices')->assertStatus(401);
    }

    public function test_create_without_authentication()
    {
        $response = $this->postJson('/api/v1/invoices', [])->assertStatus(401);
    }

    public function test_delete_without_authentication()
    {
        $this->deleteJson('/api/v1/invoices/12345')->assertStatus(401);
    }

    public function test_crud_operations()
    {
        $client_id = factory(Client::class)->create()->id;
        $payload   = [
            'reference_no' => generateCode('invoices'),
            'client_id'    => $client_id,
            'currency'     => 'USD',
        ];
        $this->createUserWithToken();
        $response = $this->postJson('/api/v1/invoices', $payload);
        $response->assertStatus(201)->assertJson([
            'id' => true,
        ]);
        $invoice  = $response->getData()->id;
        $response = $this->getJson('/api/v1/invoices/' . $invoice);
        $response->assertStatus(200)->assertJson([
            'id' => true,
        ]);
        $response = $this->putJson('/api/v1/invoices/' . $invoice, array_prepend($payload, now()->addDays(14)->toDateTimeString(), 'due_date'));
        $response->assertStatus(200)->assertJson([
            'id' => true,
        ]);
        $response = $this->getJson('/api/v1/invoices');
        $response->assertStatus(200)->assertJson([
            'data' => true,
        ]);
        $response = $this->deleteJson('/api/v1/invoices/' . $invoice);
        $response->assertStatus(200)->assertJson([
            'message' => true,
        ]);
    }

    public function test_get_undefined_invoice()
    {
        $this->createUserWithToken();
        $this->getJson('/api/v1/invoices/13232323')->assertStatus(404);
    }

    public function test_create_without_payload()
    {
        $this->createUserWithToken();
        $this->postJson('/api/v1/invoices', [])->assertStatus(422);
    }

    public function test_delete_undefined_invoice()
    {
        $this->createUserWithToken();
        $this->deleteJson('/api/v1/invoices/13232323')->assertStatus(404);
    }
}
