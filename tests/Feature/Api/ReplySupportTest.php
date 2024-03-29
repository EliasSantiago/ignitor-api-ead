<?php

namespace Tests\Feature\Api;

use App\Models\Support;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReplySupportTest extends TestCase
{
  use UtilsTrait;

  public function test_create_reply_to_support_unauthenticated()
  {
    $response = $this->postJson('/api/replies');
    $response->assertStatus(401);
  }

  public function test_create_reply_to_support_error_validations()
  {
    $response = $this->postJson('/api/replies', [], $this->defaultHeaders());
    $response->assertStatus(422);
  }

  public function test_create_reply_to_support()
  {
    $support = Support::factory()->create();
    $payload = [
      'support_id'  => $support->id,
      'description' => 'Teste de resposta'
    ];
    $response = $this->postJson('/api/replies', $payload, $this->defaultHeaders());
    $response->assertStatus(201);
  }
}
