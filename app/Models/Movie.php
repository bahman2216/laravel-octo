<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = ['title', 'release', 'length', 'description', 'mpaa_rating'];
    protected $table = 'Movie';
    protected $hidden = ['created_at', 'updated_at'];

    use HasFactory;

    /**
     * The genres that belong to the movie.
     */
    public function genres()
    {

        return $this->belongsToMany(Genre::class);
    }

    /**
     * The performers that belong to the movie.
     */
    public function performers()
    {

        return $this->belongsToMany(Performer::class, 'movie_performer');
    }

    /**
     * The directors that belong to the movie.
     */
    public function directors()
    {

        return $this->belongsToMany(Director::class);
    }

    /**
     * The languages that belong to the movie.
     */
    public function languages()
    {

        return $this->belongsToMany(Language::class);
    }

    /**
     * The movie rating that has many movies.
     */
    public function movie_ratings()
    {

        return $this->hasMany(MovieRating::class);
    }

    public function avgRating()
    {
        return $this->movie_ratings()
            ->selectRaw('avg(rating) as aggregate, movie_id')
            ->groupBy('movie_id');
    }

    public function getAvgRatingAttribute()
    {
        if (!array_key_exists('avgRating', $this->relations)) {
            $this->load('avgRating');
        }

        $relation = $this->getRelation('avgRating')->first();

        return ($relation) ? number_format($relation->aggregate, 1) : null;
    }
}
