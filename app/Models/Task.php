<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_task';
    protected $guarded = ['id_task'];
    protected $table = 'task';

    public function projects(){
        return $this->belongsTo(Project::class, 'id_projects', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'id', 'id');
    }

    public function progressTask(){
        return $this->hasMany(ProgressTask::class, 'id_task', 'id_task');
    }

    public function imageTask(){
        return $this->hasMany(ImageTask::class, 'id_task', 'id_task');
    }

}
