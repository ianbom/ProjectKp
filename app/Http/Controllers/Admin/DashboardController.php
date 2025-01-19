<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $admin = User::count();
        $client = Client::count();
        $project = Project::count();

        $recentclient = Client::latest()->take(5)->get();
       // $recentnoti = DB::table('comments')->join('clients', 'comments.commentable_id', '=', 'clients.id')->select('comments.*', 'clients.id', 'clients.name', 'clients.slug', 'clients.password')->where('comments.deleted_at', NULL)->where('comments.commenter_id', NULL)->latest('comments.created_at')->take(5)->get();

       $recentnoti = DB::table('comments')
       ->join('clients', 'comments.commentable_id', '=', 'clients.id')
       ->select(
           'comments.comment',
           'clients.id as client_id',
           'clients.name as guest_name',
           'clients.slug as slug',
           'comments.created_at as created_at'
       )
       ->where('comments.commentable_type', 'App\\Models\\Client')
       ->whereNull('comments.deleted_at')
       ->latest('comments.created_at')
       ->take(5)
       ->get();

      

        return view('pages.admin.dashboard', [
            'admin' => $admin,
            'client' => $client,
            'project' => $project,
            'recentclient' => $recentclient,
            'recentnoti' => $recentnoti,

        ]);

        // return response()->json([  'admin' => $admin,
        // 'client' => $client,
        // 'project' => $project,
        // 'recentclient' => $recentclient,
        // 'recentnoti' => $recentnoti,]);
    }
}
