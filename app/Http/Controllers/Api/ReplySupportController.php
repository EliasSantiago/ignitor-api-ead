<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReplySupport;
use App\Http\Resources\ReplySupportResource;
use App\Repositories\ReplySupportRepository;

class ReplySupportController extends Controller
{

  protected $repository;

  public function __construct(ReplySupportRepository $repository)
  {
    $this->repository = $repository;
  }

  public function createReply(StoreReplySupport $request)
  {
    $reply = $this->repository->createReplyToSupport($request->validated());
    return new ReplySupportResource($reply);
  }
}
