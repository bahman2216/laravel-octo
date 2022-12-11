<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Performer extends Model
{
    protected $fillable = ['name'];
    protected $table = 'Performer';
    protected $hidden = ['created_at', 'updated_at'];

    use HasFactory;

    public function movies() {
        return $this->belongsToMany(Movie::class, 'movie_performer');
    }
}
