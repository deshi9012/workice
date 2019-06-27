<?php

namespace Tests\Endpoints;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Modules\Users\Entities\User;
use Tests\TestCase;
use Tests\Traits\InteractsWithPassport;

class DealTest extends TestCase
{
    use DatabaseTransactions, WithFaker, InteractsWithPassport;

    protected function setUp()
    {
        parent::setUp();
        Notification::fake();
    }

    public function test_view_without_authentication()
    {
        $response = $this->getJson('/api/v1/deals')->assertStatus(401);
    }

    public function test_create_without_authentication()
    {
        $response = $this->postJson('/api/v1/deals', [])->assertStatus(401);
    }

    public function test_delete_without_authentication()
    {
        $this->deleteJson('/api/v1/deals/12345')->assertStatus(401);
    }

    public function test_crud_operations()
    {
        $this->createUserWithToken();
        $payload = [
            'title'          => 'Test Deal',
            'pipeline'       => 19,
            'stage_id'       => 37,
            'source'         => 24,
            'deal_value'     => 500,
            'contact_person' => User::latest()->first()->id,
        ];

        $response = $this->postJson('/api/v1/deals', $payload);
        $response->assertStatus(201)->assertJson([
            'id' => true,
        ]);
        $deal     = $response->getData()->id;
        $response = $this->getJson('/api/v1/deals/' . $deal);
        $response->assertStatus(200)->assertJson([
            'id' => true,
        ]);
        $response = $this->putJson('/api/v1/deals/' . $deal, array_prepend($payload, '900', 'deal_value'));
        $response->assertStatus(200)->assertJson([
            'id' => true,
        ]);
        $response = $this->getJson('/api/v1/deals');
        $response->assertStatus(200)->assertJson([
            'data' => true,
        ]);
        $response = $this->deleteJson('/api/v1/deals/' . $deal);
        $response->assertStatus(200)->assertJson([
            'message' => true,
        ]);
    }

    public function test_get_undefined_deal()
    {
        $this->createUserWithToken();
        $this->getJson('/api/v1/deals/13232323')->assertStatus(404);
    }

    public function test_create_without_payload()
    {
        $this->createUserWithToken();
        $this->postJson('/api/v1/deals', [])->assertStatus(422);
    }

    public function test_delete_undefined_deal()
    {
        $this->createUserWithToken();
        $this->deleteJson('/api/v1/deals/13232323')->assertStatus(404);
    }
}
