<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    use HasFactory;

    protected $fillable = ['requester_id', 'approver_id', 'type', 'title', 'description', 'details', 'status', 'rejection_reason', 'start_date', 'end_date', 'amount'];

    protected $casts = [
        'details' => 'array',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function requester()
    {
        return $this->belongsTo(User::class, 'requester_id');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approver_id');
    }
}
