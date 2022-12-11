<?php

namespace App\Http\Resources;

use App\Models\Movie;
use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
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
            'Genre' =>    $this->genres()->select('name')->get(),
            'Description' => $this->description,
        ];
    }

    public function index()
    {
        $movies = Movie::paginate();

        return Movieresource::collection($movies);
    }
}
