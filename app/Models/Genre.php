<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $fillable = ['name'];
    protected $table = 'Genre';
    protected $hidden = ['created_at', 'updated_at', 'pivot'];

    use HasFactory;

    /**
     * The movies that belong to the genre.
     */
    public function movies()
    {
        return $this->belongsToMany(Movie::class);
    }
}
