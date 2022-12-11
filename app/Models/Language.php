<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = ['name'];
    protected $table = 'Language';
    protected $hidden = ['created_at', 'updated_at']; 

    use HasFactory;
}
