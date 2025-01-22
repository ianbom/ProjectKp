<?php

namespace App\Http\Controllers;

use App\Models\ImageTask;
use App\Models\ProgressTask;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
//use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\DataTables;

class TaskController extends Controller
{
    public function index(){
        return view('pages.admin.task.index_task');
    }

    public function dataTask()
{
    $data = Task::with(['user', 'projects'])
        ->select('task.*')
        ->join('users', 'task.id', '=', 'users.id')
        ->leftJoin('projects', 'task.id_projects', '=', 'projects.id')
        ->get();

    return DataTables::of($data)
        ->addColumn('user_name', function ($data) {
            return $data->user->name;
        })
        ->addColumn('project_name', function ($data) {
            return $data->projects ? $data->projects->name : 'No Project';
        })
        ->editColumn('created_at', function ($data) {
            return Carbon::parse($data->created_at)->translatedFormat('d F Y');
        })
        ->editColumn('updated_at', function ($data) {
            return Carbon::parse($data->updated_at)->translatedFormat('d F Y');
        })
        ->addColumn('action', function ($data) {
            $deleteUrl = route('task.delete', $data->id_task);
            $editUrl = route('task.edit', $data->id_task);
            $detailUrl = route('task.detail', $data->id_task);

            return '
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        Actions
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="' . $detailUrl . '">Detail</a></li>
                        <li><a class="dropdown-item" href="' . $editUrl . '">Edit</a></li>
                        <li>
                            <form action="' . $deleteUrl . '" method="POST" onsubmit="return confirm(\'Are you sure you want to delete this task?\');" style="display:inline;">
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                                <button type="submit" class="dropdown-item text-danger">Delete</button>
                            </form>
                        </li>
                    </ul>
                </div>
            ';
        })
        ->rawColumns(['action'])
        ->make(true);
}



    public function create(){
        $projects = Project::all();
        $user = User::all();

        return view('pages.admin.task.create_task', ['projects' => $projects, 'user' => $user]);
    }

    public function store(Request $request){
    try {
        $request->validate([
            'id_projects' => 'nullable',
            'id' => 'required',
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|array',
            'image.*' => 'file|mimes:jpeg,png,jpg,pdf'
        ]);
        $task = Task::create([
            'id_projects' => $request->id_projects,
            'id' => $request->id,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        $this->kirimWaTask($task->user->phone, "Pemberitahuan Task Baru.
        To {$task->user->name}
        Title {$task->title}
        Description {$task->description}"
    );

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {

                $imagePath = $image->store('tasks', 'public');


                ImageTask::create([
                    'id_task' => $task->id_task,
                    'image' => $imagePath,
                ]);
            }
        }

        return redirect()->route('task.index')->with('success', 'Task created successfully');
    } catch (\Throwable $th) {
        return response()->json(['error', $th->getMessage()]);
    }
}

    public function edit($id){
        $task = Task::with('projects')->findOrFail($id);
        $projects = Project::all();
        $user = User::all();
        //  return response()->json(['task' => $task]);
        return view('pages.admin.task.edit_task', ['task' => $task, 'projects' => $projects, 'user' => $user]);
    }



    public function update(Request $request, $id_task)
{
    try {

        $request->validate([
            'id_projects' => 'nullable',
            'id' => 'required',
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'sometimes|array',
            'image.*' => 'file|mimes:jpeg,png,jpg,pdf'
        ]);

        $task = Task::findOrFail($id_task);
        // $oldTaskData = $task->getOriginal();

        $task->update([
            'id_projects' => $request->id_projects,
            'id' => $request->id,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        // activity()
        // ->performedOn($task)
        // ->causedBy(auth()->user())
        // ->withProperties([
        //     'old' => $oldTaskData,
        //     'new' => $task->getChanges(),
        // ])
        // ->log('Task updated');


        if ($request->hasFile('image')) {

            foreach ($request->file('image') as $image) {
                $imagePath = $image->store('tasks', 'public');

                ImageTask::create([
                    'id_task' => $task->id_task,
                    'image' => $imagePath,
                ]);
            }
        }

        return redirect()->route('task.index')->with('success', 'Success update task with images');

    } catch (\Throwable $th) {
        return response()->json(['error' => $th->getMessage()]);
    }
}


    public function delete($id){
        $task = Task::findOrFail($id);
        $task->delete();
        return redirect()->back()->with('success', 'Task Deleted successfully');
    }

    public function deleteImage($id){
        $image = ImageTask::findOrFail($id);
        $image->delete();

        return redirect()->back()->with('success', 'Image deleted successfully');
    }

    public function detail($id){
        $task = Task::findOrFail($id);
        return view('pages.admin.task.detail_task', ['task' => $task]);
    }

    public function detailProgress($id){
        $progress = ProgressTask::findOrFail($id);

        return view('pages.admin.task.edit_progress_task', ['progress' => $progress]);
    }

    public function editDetailProgress($id){
        $progress = ProgressTask::findOrFail($id);

        return view('pages.admin.task.admin_edit_detail_progress', ['progress' => $progress]);
    }

    public function updateProgress($id, Request $request){
        $progress = ProgressTask::findOrFail($id);

        $progress->comment = $request->comment;
        $progress->status = $request->status;
        $progress->save();

        return redirect()->back()->with('success', 'Success update progress task');
    }

    private function kirimWaTask($target, $message,){
        try {
            $response = Http::withHeaders([
                'Authorization' => env('FONNTE_API_KEY'),
            ])->post('https://api.fonnte.com/send', [
                'target' => $target,
                'message' => $message,

            ]);

            $result = json_decode($response, true);

        } catch (\Throwable $th) {
           return response()->json(['error' => $th->getMessage()]);
        }

    }

}
