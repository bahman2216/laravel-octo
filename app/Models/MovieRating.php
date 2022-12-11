<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieRating extends Model
{
    protected $table = 'Movie_Rating';
    protected $fillable = ['movie_id', 'rating', 'r_description', 'user_id'];

    use HasFactory;

    /**
     * The movie rating that blongs to movies.
    */
    public function movies() {

        return $this->belongsTo(Movie::class);
    }
}
