<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSlot extends Model
{
    protected $fillable = ['theater_id', 'movie_id', 'theater_room_no', 'statr_time', 'end_time'];
    protected $table = 'Time_Slot';
    protected $hidden = ['created_at', 'updated_at'];

    use HasFactory;

    public function movie() {
        return $this->belongsTo(Movie::class);
    }

    public function theater() {
        return $this->belongsTo(Theater::class);
    }
}
