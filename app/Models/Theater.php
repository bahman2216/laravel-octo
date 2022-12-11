<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theater extends Model
{
    protected $fillable = ['name'];
    protected $table = 'Theater';
    protected $hidden = ['created_at', 'updated_at'];

    use HasFactory;

    public function timeSlote() {

        return $this->hasOne(TimeSlot::class);
    }
}
