<?php

namespace Tests\Endpoints;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Modules\Clients\Entities\Client;
use Modules\Invoices\Entities\Invoice;
use Tests\TestCase;
use Tests\Traits\InteractsWithPassport;

class PaymentTest extends TestCase
{
    use DatabaseTransactions, WithFaker, InteractsWithPassport;

    protected function setUp()
    {
        parent::setUp();
        Notification::fake();
    }

    public function test_view_without_authentication()
    {
        $response = $this->getJson('/api/v1/payments')->assertStatus(401);
    }

    public function test_create_without_authentication()
    {
        $response = $this->postJson('/api/v1/payments', [])->assertStatus(401);
    }

    public function test_delete_without_authentication()
    {
        $this->deleteJson('/api/v1/payments/12345')->assertStatus(401);
    }

    public function test_crud_operations()
    {
        $invoice            = factory(Invoice::class)->make();
        $invoice->client_id = factory(Client::class)->create()->id;
        $invoice->save();
        $payload = [
            'invoice_id'     => $invoice->id,
            'payment_date'   => now()->toDateTimeString(),
            'amount'         => 30,
            'payment_method' => 2,
            'gateway'        => 'offline',
            'line_items'     => array([
                'name'        => 'Test Item',
                'description' => 'Test Description',
                'quantity'    => 2,
                'unit_cost'   => 600,
            ]),
        ];
        $this->createUserWithToken();
        $response = $this->postJson('/api/v1/payments', $payload);
        $response->assertStatus(200)->assertJson([
            'id' => true,
        ]);
        $payment  = $response->getData()->id;
        $response = $this->getJson('/api/v1/payments/' . $payment);
        $response->assertStatus(200)->assertJson([
            'id' => true,
        ]);
        $response = $this->putJson('/api/v1/payments/' . $payment, array_prepend($payload, 'test@me.com', 'payer_email'));
        $response->assertStatus(200)->assertJson([
            'id' => true,
        ]);
        $response = $this->getJson('/api/v1/payments');
        $response->assertStatus(200)->assertJson([
            'data' => true,
        ]);
        $response = $this->deleteJson('/api/v1/payments/' . $payment);
        $response->assertStatus(200)->assertJson([
            'message' => true,
        ]);
    }

    public function test_get_undefined_payment()
    {
        $this->createUserWithToken();
        $this->getJson('/api/v1/payments/13232323')->assertStatus(404);
    }

    public function test_create_without_payload()
    {
        $this->createUserWithToken();
        $this->postJson('/api/v1/payments', [])->assertStatus(422);
    }

    public function test_delete_undefined_payment()
    {
        $this->createUserWithToken();
        $this->deleteJson('/api/v1/payments/13232323')->assertStatus(404);
    }
}
