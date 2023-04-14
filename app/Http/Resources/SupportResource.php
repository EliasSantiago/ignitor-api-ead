<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SupportResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array
  {
    return [
      'id'           => $this->id,
      'status'       => $this->status,
      'status_label' => $this->statusOptions[$this->status] ?? 'Not Found Status',
      'description'  => $this->description,
      'user'         => new UserResource($this->user),
      'lesson'       => new LessonResource($this->whenLoaded('lessons')),
      //'replies'      => ReplySupportResource::collection($this->whenLoaded('replies')),
      'replies'      => ReplySupportResource::collection($this->replies),
      'updated_at'   => Carbon::make($this->updated_at)->format('Y-m-d H:i:s'),
    ];
  }
}
