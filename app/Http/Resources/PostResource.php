<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user' => $this->user->name,
            'content' => $this->content,
            'reaction' => $this->reaction->map(function ($reaction) {
                return [
                    'id' => $reaction->id,
                    'type' => $reaction->type,
                    'user' => $reaction->user->name,
                ];
            }),
            'comments' => $this->comments->map(function ($comments) {
                return [
                    'id' => $comments->id,
                    'post_id' => $comments->post_id,
                    'user' => $comments->user->name,
                    'content' => $comments->content
                ];
            })
        ];
    }
}