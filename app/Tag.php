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

    public static function getIds($tagString)
    {
        $tagsRawArray = explode(',', $tagString);
        
        return collect($tagsRawArray)->map(function ($tag, $key) {
                return trim($tag);
            })->filter()->map(function ($tag, $key) {
                return Tag::firstOrCreate(['name' => $tag])->id;
            })->toArray();
    }
}