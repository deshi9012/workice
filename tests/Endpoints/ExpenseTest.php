<?php

namespace Tests\Endpoints;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Notification;
use Modules\Clients\Entities\Client;
use Tests\TestCase;
use Tests\Traits\InteractsWithPassport;

class ExpenseTest extends TestCase
{
    use DatabaseTransactions, InteractsWithPassport;

    protected function setUp()
    {
        parent::setUp();
        Notification::fake();
    }

    public function test_view_without_authentication()
    {
        $response = $this->getJson('/api/v1/expenses')->assertStatus(401);
    }

    public function test_create_without_authentication()
    {
        $response = $this->postJson('/api/v1/expenses', [])->assertStatus(401);
    }

    public function test_delete_without_authentication()
    {
        $this->deleteJson('/api/v1/expenses/12345')->assertStatus(401);
    }

    public function test_crud_opeartions()
    {
        $client_id = factory(Client::class)->create()->id;
        $payload   = [
            'code'         => generateCode('expenses'),
            'client_id'    => $client_id,
            'amount'       => 100,
            'category'     => 1,
            'expense_date' => now()->toDateTimeString(),
            'currency'     => 'USD',
        ];
        $this->createUserWithToken();
        $response = $this->postJson('/api/v1/expenses', $payload);
        $response->assertStatus(201)->assertJson([
            'id' => true,
        ]);
        $expense  = $response->getData()->id;
        $response = $this->getJson('/api/v1/expenses/' . $expense);
        $response->assertStatus(200)->assertJson([
            'id' => true,
        ]);
        $response = $this->putJson('/api/v1/expenses/' . $expense, array_prepend($payload, 'Safaricom', 'vendor'));
        $response->assertStatus(200)->assertJson([
            'id' => true,
        ]);
        $response = $this->getJson('/api/v1/expenses');
        $response->assertStatus(200)->assertJson([
            'data' => true,
        ]);
        $response = $this->deleteJson('/api/v1/expenses/' . $expense);
        $response->assertStatus(200)->assertJson([
            'message' => true,
        ]);
    }

    public function test_get_undefined_expense()
    {
        $this->createUserWithToken();
        $this->getJson('/api/v1/expenses/13232323')->assertStatus(404);
    }

    public function test_create_without_payload()
    {
        $this->createUserWithToken();
        $this->postJson('/api/v1/expenses', [])->assertStatus(422);
    }

    public function test_delete_undefined_expense()
    {
        $this->createUserWithToken();
        $this->deleteJson('/api/v1/expenses/13232323')->assertStatus(404);
    }
}
