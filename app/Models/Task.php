<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Task extends Model
{
    use HasFactory, LogsActivity;
    protected $primaryKey = 'id_task';
    protected $guarded = ['id_task'];
    protected $table = 'task';

    // protected static $logAttributes = ['id_projects', 'id', 'title', 'description'];
    // protected static $logName = 'task';
    // // protected static $logOnlyDirty = false;

    // public function getDescriptionForEvent(string $eventName): string
    // {
    //     return "Task has been {$eventName}";
    // }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
                ->logOnly(['id_projects', 'id', 'title', 'description'])
                ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}")
                ->useLogName('Task');
    }

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
