<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    protected $fillable = ['name'];
    protected $table = 'Director';
    protected $hidden = ['created_at', 'updated_at']; 

    use HasFactory;
}
