<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreView;
use App\Http\Resources\LessonResource;
use App\Repositories\LessonRepository;

class LessonController extends Controller
{
  protected $repository;

  public function __construct(LessonRepository $repository)
  {
    $this->repository = $repository;
  }

  public function index($moduleId)
  {
    $lessons = $this->repository->getLessonByModuleId($moduleId);
    return LessonResource::collection($lessons);
  }

  public function show($id)
  {
    return new LessonResource($this->repository->getById($id));
  }

  public function viewed(StoreView $request)
  {
    $this->repository->viewed($request->lesson_id);
    return response()->json([
      'success' => 'Lesson viewed',
    ]);
  }
}
