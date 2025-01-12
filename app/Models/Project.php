<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravelista\Comments\Commentable;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Commentable;

    protected $fillable = [
        'clients_id', 'name', 'jenis', 'keterangan', 'deadline',
        'status',
        'progress',
        'masaaktif', 'notes',
        'photo',
    ];

    public function client(){
        return $this->belongsTo(Client::class, 'clients_id', 'id');
    }


    protected $hidden = [];
}
