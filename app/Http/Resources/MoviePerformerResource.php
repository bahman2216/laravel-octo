<?php

namespace App\Http\Resources;

use App\Models\Movie;
use Illuminate\Http\Resources\Json\JsonResource;

class MoviePerformerResource extends JsonResource
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
            'Movie_ID' => $this->id,
            'Title' => $this->title,
            'Overall_rating' =>   $this->avgRating,
            'Description' => $this->description,
        ];
    }
}
