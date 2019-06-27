<?php

namespace Tests\Endpoints;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;
use Tests\Traits\InteractsWithPassport;

class UserTest extends TestCase
{
    use DatabaseTransactions, WithFaker, InteractsWithPassport;

    protected function setUp()
    {
        parent::setUp();
        Notification::fake();
    }

    public function test_view_without_authentication()
    {
        $response = $this->getJson('/api/v1/users')->assertStatus(401);
    }

    public function test_create_without_authentication()
    {
        $response = $this->postJson('/api/v1/users', [])->assertStatus(401);
    }

    public function test_delete_without_authentication()
    {
        $this->deleteJson('/api/v1/users/12345')->assertStatus(401);
    }
    public function test_crud_operations()
    {
        $payload = [
            'username' => $this->faker->unique()->userName,
            'name'     => $this->faker->name,
            'email'    => $this->faker->unique()->safeEmail,
            'password' => '',
        ];
        $this->createUserWithToken();
        $response = $this->postJson('/api/v1/users', $payload);
        $response->assertStatus(201)->assertJson([
            'id' => true,
        ]);
        $user     = $response->getData()->id;
        $response = $this->getJson('/api/v1/users/' . $user);
        $response->assertStatus(200)->assertJson([
            'id' => true,
        ]);
        $response = $this->putJson('/api/v1/users/' . $user, array_prepend($payload, now()->toDateTimeString(), 'email_verified_at'));
        $response->assertStatus(200)->assertJson([
            'id' => true,
        ]);
        $response = $this->getJson('/api/v1/users');
        $response->assertStatus(200)->assertJson([
            'data' => true,
        ]);
        $response = $this->deleteJson('/api/v1/users/' . $user);
        $response->assertStatus(200)->assertJson([
            'message' => true,
        ]);
    }

    public function test_get_undefined_user()
    {
        $this->createUserWithToken();
        $this->getJson('/api/v1/users/13232323')->assertStatus(404);
    }

    public function test_create_without_payload()
    {
        $this->createUserWithToken();
        $this->postJson('/api/v1/users', [])->assertStatus(422);
    }
}
