<?php

namespace App\Http\Controllers;

use App\Models\ImageTask;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
//use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\DataTables;

class TaskController extends Controller
{
    public function index(){
        return view('pages.admin.task.index_task');
    }

    public function dataTask() {
        $data = Task::with(['user', 'projects'])  // Gunakan eager loading
            ->select('task.*')  // Pilih semua kolom dari tabel task
            ->join('users', 'task.id', '=', 'users.id')
            ->join('projects', 'task.id_projects', '=', 'projects.id', 'left')  // Left join karena id_projects bisa null
            ->get();

        return DataTables::of($data)
            ->addColumn('user_name', function ($data) {
                return $data->user->name;  // Ambil nama user
            })
            ->addColumn('project_name', function ($data) {
                return $data->projects ? $data->projects->name : 'No Project';  // Ambil nama project atau 'No Project' jika null
            })
            ->addColumn('action', function ($data){
                return '<a href="#" class="btn btn-sm btn-warning">Edit</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }


    public function create(){
        $projects = Project::all();
        $user = User::all();

        return view('pages.admin.task.create_task', ['projects' => $projects, 'user' => $user]);
    }

    public function store(Request $request)
{
    try {

        // if ($request->hasFile('image')) {
        //     dd($request->file('image')); // Hentikan proses dan tampilkan isi array file
        // } else {
        //     dd('No images uploaded');
        // }

        $request->validate([
            'id_projects' => 'nullable',
            'id' => 'required',
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|array',
            'image.*' => 'file|mimes:jpeg,png,jpg,pdf'
        ]);

        // Buat task baru
        $task = Task::create([
            'id_projects' => $request->id_projects,
            'id' => $request->id,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        // Cek apakah ada gambar yang diunggah
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                // Simpan gambar ke direktori
                $imagePath = $image->store('tasks', 'public'); // Menyimpan gambar di storage/app/public/images/tasks

                // Simpan informasi gambar ke tabel 'task_image'
                ImageTask::create([
                    'id_task' => $task->id_task, // Hubungkan dengan task yang baru dibuat
                    'image' => $imagePath,
                ]);
            }
        }


        return redirect()->back()->with('success', 'Success create task with images');

    } catch (\Throwable $th) {
        return response()->json(['error', $th->getMessage()]);
    }
}

    public function edit($id){
        $task = Task::findOrFail($id);
        return view('pages.admin.task.edit_task', ['task' => $task]);
    }

    public function update(Request $request, $id_task)
{
    try {
        // Validasi input
        $request->validate([
            'id_projects' => 'nullable',
            'id' => 'required',
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'sometimes|array', // File bersifat opsional
            'image.*' => 'file|mimes:jpeg,png,jpg,pdf'
        ]);

        // Cari task berdasarkan ID
        $task = Task::findOrFail($id_task);

        // Update data task
        $task->update([
            'id_projects' => $request->id_projects,
            'id' => $request->id,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        // Cek apakah ada file baru yang diunggah
        if ($request->hasFile('image')) {
            // Hapus file lama jika ada
            foreach ($task->images as $existingImage) {
                // Hapus file dari storage
                Storage::disk('public')->delete($existingImage->image);
                // Hapus dari database
                $existingImage->delete();
            }

            // Simpan file baru
            foreach ($request->file('image') as $image) {
                // Simpan file ke direktori storage
                $imagePath = $image->store('tasks', 'public');

                // Simpan informasi gambar ke tabel 'task_image'
                ImageTask::create([
                    'id_task' => $task->id_task,
                    'image' => $imagePath,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Success update task with images');

    } catch (\Throwable $th) {
        return response()->json(['error' => $th->getMessage()]);
    }
}


    public function delete($id){
        $task = Task::findOrFail($id);
        $task->delete();
        return redirect()->back()->with('success', 'Success hapus task');
    }

}
