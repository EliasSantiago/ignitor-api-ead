<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReplySupportResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array
  {
    return [
      'id'          => $this->id,
      'description' => $this->description,
      'support'     => new SupportResource($this->whenLoaded('support')),
      'user'        => new UserResource($this->user),
      'updated_at'   => Carbon::make($this->updated_at)->format('Y-m-d H:i:s'),
    ];
  }
}
