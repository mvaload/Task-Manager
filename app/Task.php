<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'name',
        'description',
        'status_id',
        'creator_id',
        'assigned_to_id'
    ];

    public function status()
    {
        return $this->belongsTo(TaskStatus::class);
    }
    
    public function creator()
    {
        return $this->belongsTo(User::class);
    }
    
    public function assignedTo()
    {
        return $this->belongsTo(User::class);
    }
}
