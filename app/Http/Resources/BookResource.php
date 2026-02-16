<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price !== null ? floatval($this->price) : null,
            'is_available' => $this->is_available,
            'tags' => $this->tags,
            'pages' => $this->pages,
            'visits' => $this->visits,
            'picture' => $this->picture,
        ];
    }
}
