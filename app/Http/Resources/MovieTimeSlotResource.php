<?php

namespace App\Http\Resources;

use App\Models\Movie;
use Illuminate\Http\Resources\Json\JsonResource;

class MovieTimeSlotResource extends JsonResource
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
            'Movie_ID' => $this->movie->id,
            'Title' => $this->movie->title,
            'Theater_name' =>    $this->theater->name,
            'Start_time' =>    $this->time_start,
            'End_time' =>    $this->time_end,
            'Description' => $this->movie->description,
            'Theater_room_no' => $this->theater_room_no,
        ];
    }
}
