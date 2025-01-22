<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravelista\Comments\Commentable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Client extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Commentable;
    use LogsActivity;


    protected $fillable = [
        'name', 'slug', 'password', 'photo', 'phone'
    ];

    protected $hidden = [];


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
                ->logOnly([ 'name', 'slug', 'password', 'phone'])
                ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}")
                ->useLogName('Client');
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'clients_id', 'id');
    }
}
