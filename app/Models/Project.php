<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravelista\Comments\Commentable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Commentable;
    use LogsActivity;

    protected $fillable = [
        'clients_id', 'name', 'jenis', 'keterangan', 'deadline',
        'status',
        'masaaktif', 'notes',
        'photo',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
                ->logOnly(['clients_id', 'name', 'jenis', 'keterangan', 'deadline','status','progress','masaaktif', 'notes',])
                ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}")
                ->useLogName('Projects');
    }

    public function client(){
        return $this->belongsTo(Client::class, 'clients_id', 'id');
    }


    protected $hidden = [];
}
