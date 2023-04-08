<?php

namespace App\Repositories;

use App\Models\Course;

class CourseRepository
{
  protected $entity;

  public function __construct(Course $model)
  {
    $this->entity = $model;   
  }

  public function getAll()
  {
    return $this->entity->with('modules.lessons')->get();
  }

  public function getById(string $id)
  {
    return $this->entity->with('modules.lessons.views')->findOrFail($id);
  }
}