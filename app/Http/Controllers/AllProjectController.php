<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class AllProjectController extends Controller
{
    public function index(){
        $projects = Project::all();
        //return response()->json(['projects' => $projects]);
        return view('pages.admin.project.all_projects', ['projects' => $projects]);
    }

    public function dataProjects()
    {
        $projects = Project::select(['id', 'clients_id', 'name', 'jenis', 'keterangan', 'deadline', 'status', 'masaaktif', 'notes', 'photo', 'created_at', 'updated_at']);

        return DataTables::of($projects)
            ->addColumn('action', function ($project) {
                 return '<a href="'.route('project.edit', $project->id).'" class="btn btn-primary btn-sm">Edit</a>
                         <form action=" ' . route('project.destroy', $project->id) . ' " method="POST">
                                    ' . method_field('delete') . csrf_field() . '
                                    <button type="submit" class="btn btn-danger">
                                        Delete
                                    </button>
                                </form>';

            })
            ->editColumn('photo', function ($project) {
                return '<img src="'.Storage::url($project->photo).'" alt="Project Photo" width="50">';
            })
            ->rawColumns(['action', 'photo'])
            ->make(true);
    }
}
