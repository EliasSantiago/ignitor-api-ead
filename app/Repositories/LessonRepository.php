<?php

namespace App\Repositories;

use App\Models\Lesson;
use App\Repositories\Traits\RepositoryTrait;

class LessonRepository
{
  use RepositoryTrait;

  protected $entity;

  public function __construct(Lesson $model)
  {
    $this->entity = $model;
  }

  public function getLessonByModuleId(string $moduleId)
  {
    return $this->entity->with('supports.replies')->where('module_id', $moduleId)->get();
  }

  public function getById(string $id)
  {
    return $this->entity->findOrFail($id);
  }

  public function viewed(string $lessonId)
  {
    $user = $this->getUserAuth();
    $view = $user->views()->where('lesson_id', $lessonId)->first();

    if ($view) {
      $view->qty += 1;
      return $view->save();
    }

    return $user->views()->create([
      'lesson_id' => $lessonId
    ]);
  }
}
