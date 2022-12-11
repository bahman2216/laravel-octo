<?php

namespace App\Http\Resources;

use App\Models\Genre;
use Illuminate\Http\Resources\Json\JsonResource;

class GenreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'Genre_ID' => $this->id,
            'Title' => $this->title,
            'Genre' => $this->release,
            'Description' => $this->description,
        ];
    }

    public function show(Genre $genre) {

        return new GenreResource($genre);
    }
}
