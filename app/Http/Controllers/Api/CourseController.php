<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use App\Repositories\CourseRepository;

class CourseController extends Controller
{

  protected $repository;

  public function __construct(CourseRepository $repository)
  {
    $this->repository = $repository;
  }

  public function index()
  {
    return CourseResource::collection($this->repository->getAll());
  }

  public function show($id)
  {
    return new CourseResource($this->repository->getById($id));
  }
}
