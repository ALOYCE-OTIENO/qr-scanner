<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    protected $fillable = ['organizer_id', 'title', 'description', 'start_time', 'end_time', 'location', 'type'];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    public function participants()
    {
        return $this->belongsToMany(User::class, 'meeting_user')->withTimestamps();
    }
}
