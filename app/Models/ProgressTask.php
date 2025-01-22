<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class ProgressTask extends Model
{
    use HasFactory, LogsActivity;
    protected $primaryKey = 'id_progress_task';
    protected $guarded = ['id_progress_task'];
    protected $table = 'progress_task';

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
                ->logOnly(['id_task', 'id', 'deskripsi', 'status', 'comment'])
                ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}")
                ->useLogName('ProgressTask');
    }

    public function task(){
        return $this->belongsTo(Task::class, 'id_task', 'id_task');
    }

    public function user(){
        return $this->belongsTo(User::class, 'id', 'id');
    }

    public function imageProgress(){
        return $this->hasMany(ImageTask::class, 'id_progress_task', 'id_progress_task');
    }
}
