<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageTask extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_task_image';
    protected $guarded = ['id_task_image'];
    protected $table = 'task_image';

    public function task(){
        return $this->belongsTo(Task::class, 'id_task', 'id_task');
    }

    public function progressTask(){
        return $this->belongsTo(ProgressTask::class, 'id_progress_task', 'id_progress_task');
    }
}
