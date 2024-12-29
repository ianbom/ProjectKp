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
            $editUrl = route('project.edit', $project->id);
            $deleteUrl = route('project.destroy', $project->id);

            return '
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        Actions
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="' . $editUrl . '">Edit</a></li>
                        <li>
                            <form action="' . $deleteUrl . '" method="POST" onsubmit="return confirm(\'Are you sure you want to delete this project?\');" style="display: inline;">
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                                <button type="submit" class="dropdown-item text-danger">Delete</button>
                            </form>
                        </li>
                    </ul>
                </div>
            ';
        })
        ->editColumn('photo', function ($project) {
            return '<img src="'.Storage::url($project->photo).'" alt="Project Photo" width="50">';
        })
        ->rawColumns(['action', 'photo'])
        ->make(true);
}


    // public function dataProjects()
    // {
    //     $projects = Project::select(['id', 'clients_id', 'name', 'jenis', 'keterangan', 'deadline', 'status', 'masaaktif', 'notes', 'photo', 'created_at', 'updated_at']);

    //     return DataTables::of($projects)
    //         ->addColumn('action', function ($project) {
    //              return '<a href="'.route('project.edit', $project->id).'" class="btn btn-primary btn-sm">Edit</a>
    //                      <form action=" ' . route('project.destroy', $project->id) . ' " method="POST">
    //                                 ' . method_field('delete') . csrf_field() . '
    //                                 <button type="submit" class="btn btn-danger">
    //                                     Delete
    //                                 </button>
    //                             </form>';

    //         })
    //         ->editColumn('photo', function ($project) {
    //             return '<img src="'.Storage::url($project->photo).'" alt="Project Photo" width="50">';
    //         })
    //         ->rawColumns(['action', 'photo'])
    //         ->make(true);
    // }
}
