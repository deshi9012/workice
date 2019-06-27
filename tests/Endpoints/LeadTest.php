<?php

namespace Tests\Endpoints;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Modules\Users\Entities\User;
use Tests\TestCase;
use Tests\Traits\InteractsWithPassport;

class LeadTest extends TestCase
{
    use DatabaseTransactions, WithFaker, InteractsWithPassport;

    protected function setUp()
    {
        parent::setUp();
        Notification::fake();
    }

    public function test_view_without_authentication()
    {
        $response = $this->getJson('/api/v1/leads')->assertStatus(401);
    }

    public function test_create_without_authentication()
    {
        $response = $this->postJson('/api/v1/leads', [])->assertStatus(401);
    }

    public function test_delete_without_authentication()
    {
        $this->deleteJson('/api/v1/leads/12345')->assertStatus(401);
    }

    public function test_crud_operations()
    {
        $this->createUserWithToken();
        $payload = [
            'name'      => $this->faker->name,
            'email'     => $this->faker->unique()->safeEmail,
            'stage_id'  => 24,
            'source'    => 26,
            'sales_rep' => User::latest()->first()->id,
        ];

        $response = $this->postJson('/api/v1/leads', $payload);
        $response->assertStatus(201)->assertJson([
            'id' => true,
        ]);
        $lead     = $response->getData()->id;
        $response = $this->getJson('/api/v1/leads/' . $lead);
        $response->assertStatus(200)->assertJson([
            'id' => true,
        ]);
        $response = $this->putJson('/api/v1/leads/' . $lead, array_prepend($payload, 'Developer', 'job_title'));
        $response->assertStatus(200)->assertJson([
            'id' => true,
        ]);
        $response = $this->getJson('/api/v1/leads');
        $response->assertStatus(200)->assertJson([
            'data' => true,
        ]);
        $response = $this->deleteJson('/api/v1/leads/' . $lead);
        $response->assertStatus(200)->assertJson([
            'message' => true,
        ]);
    }
    public function test_get_undefined_lead()
    {
        $this->createUserWithToken();
        $this->getJson('/api/v1/leads/13232323')->assertStatus(404);
    }

    public function test_create_without_payload()
    {
        $this->createUserWithToken();
        $this->postJson('/api/v1/leads', [])->assertStatus(422);
    }

    public function test_delete_undefined_lead()
    {
        $this->createUserWithToken();
        $this->deleteJson('/api/v1/leads/13232323')->assertStatus(404);
    }
}
