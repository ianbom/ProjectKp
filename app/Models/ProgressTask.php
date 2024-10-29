<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgressTask extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_progress_task';
    protected $guarded = ['id_progress_task'];
    protected $table = 'progress_task';

    public function task(){
        return $this->belongsTo(Task::class, 'id_task', 'id_task');
    }

    public function user(){
        return $this->belongsTo(User::class, 'id', 'id');
    }

    public function imageTask(){
        return $this->hasMany(ImageTask::class, 'id_progress_task', 'id_progress_task');
    }
}
