<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
          'id' => $this->slug,
          'guild' => $this->guild->slug,
          'type' => $this->type,
          'title' => $this->title,
          'summary' => $this->summary,
          'mission' => $this->mission,
          'systems' => $this->systems,
          'tags' => $this->tags->pluck('name'),
          'reward' => $this->reward,
          'active' => $this->active,
        ];
    }
}
