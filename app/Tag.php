<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Task;

class Tag extends Model
{
    protected $fillable = ['name'];

    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'task_tag');
    }
}
