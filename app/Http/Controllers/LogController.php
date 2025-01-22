<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;

class LogController extends Controller
{
    public function index(){
        $log = DB::table('activity_log')
        ->leftJoin('users', 'activity_log.causer_id', '=', 'users.id')
        ->select('activity_log.*', 'users.name as user_name')
        ->orderBy('activity_log.created_at', 'desc')
        ->get();

    return view('pages.admin.log.index_log', ['log' => $log]);
    }

    public function show(Activity $log ){


        return view('pages.admin.log.detail_log', ['log' => $log]);
    }
}
