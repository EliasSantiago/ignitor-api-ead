<?php

namespace Tests\Feature\Api;

use App\Models\User;

trait UtilsTrait
{
  public function createUser()
  {
    return User::factory()->create();
  }

  public function createTokenUser()
  {
    $user = $this->createUser();
    $token = $user->createToken('test')->plainTextToken;
    return $token;
  }

  public function defaultHeaders()
  {
    return [
      'Authorization' => "Bearer {$this->createTokenUser()}"
    ];
  }
}
