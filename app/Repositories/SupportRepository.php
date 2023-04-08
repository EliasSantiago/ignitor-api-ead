<?php

namespace App\Repositories;

use App\Models\Support;
use App\Repositories\Traits\RepositoryTrait;

class SupportRepository
{
  use RepositoryTrait;
  protected $entity;

  public function __construct(Support $model)
  {
    $this->entity = $model;   
  }

  public function getMySupports(array $filters = [])
  {
    $filters['user'] = true;
    return $this->getSupports($filters);
  }

  public function getSupports(array $filters = [])
  {
    return $this->entity
      ->where(function ($query) use ($filters) {
        if (isset($filters['lesson_id'])) {
          $query->where('lesson_id', $filters['lesson_id']);
        }
        if (isset($filters['status'])) {
          $query->where('status', $filters['status']);
        }
        if (isset($filters['description'])) {
          $query->where('description', 'LIKE', "%{$filters['description']}%");
        }
        if (isset($filters['user'])) {
          $query->where('user_id', $this->getUserAuth()->id);
        }
      })
      ->with('replies')
      ->orderBy('updated_at')
      ->get();
  }

  public function createSupport(array $data): Support
  {
    $data['user_id'] = $this->getUserAuth()->id;
    return $this->entity->create($data);
  }

  public function createReplyToSupportId(string $supportId, array $data)
  {
    $user = $this->getUserAuth();
    return $this->getSupport($supportId)->replies()->create([
      'user_id' => $user->id,
      'description' => $data['description'],
    ]);
  }

  private function getSupport(string $id) {
    return $this->entity->findOrFail($id);
  }
}