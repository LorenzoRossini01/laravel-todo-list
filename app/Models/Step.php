<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    use HasFactory;

    protected $fillable = ['task_id', 'title', 'description', 'completed'];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
