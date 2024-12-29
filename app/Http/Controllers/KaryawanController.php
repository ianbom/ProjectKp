<?php

namespace App\Http\Controllers;

use App\Models\ImageTask;
use App\Models\ProgressTask;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KaryawanController extends Controller
{
    public function indexTask(){
        $userId = Auth::id();
        $task = Task::where('id', $userId)->get();

        //return response()->json(['task' => $task]);
        return view('pages.karyawan.progress.index_task', ['task' => $task]);
    }

    public function detailTask($id){
        $task = Task::with('projects', 'progressTask', 'imageTask')->findOrFail($id);

        //return response()->json(['task' => $task]);
        return view('pages.karyawan.progress.progress_task', ['task' => $task]);
    }

    public function createProgress($id){
        $task = Task::with('projects', 'progressTask', 'imageTask')->findOrFail($id);

        return view('pages.karyawan.progress.create_progress', ['task' => $task]);
    }

    public function storeProgress($id, Request $request){

        $userId = Auth::id();
        $task = Task::with('projects', 'progressTask', 'imageTask')->findOrFail($id);

        try {
            $request->validate([
                'id_task' => 'required',
                'id' => 'required',
                'deskripsi' => 'required',
                'status' => 'nullable',
                'comment' => 'nullable',
                'image' => 'nullable',
                'image.*' => 'file|mimes:jpeg,png,jpg,pdf'
            ]);

            $progress = ProgressTask::create([
                'id_task' => $task->id_task,
                'id' => $userId,
                'deskripsi' => $request->deskripsi,
                'status' => 'On-Going',
            ]);

            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $image) {
                    $imagePath = $image->store('progress', 'public');

                    ImageTask::create([
                        'id_progress_task' => $progress->id_progress_task,
                        'image' => $imagePath,
                    ]);
                }
            }

            return redirect(url()->previous())->with('success', 'Berhasil Tersimpan');

        } catch (\Throwable $th) {
            return response()->json(['err' => $th->getMessage()]);
        }

    }

    public function detailProgress($id){
        $progress = ProgressTask::with('imageProgress')->findOrFail($id);

        //return response()->json(['progress' => $progress]);
        return view('pages.karyawan.progress.detail_progress', ['progress' => $progress]);
    }

    public function editProgress($id){
        $progress = ProgressTask::with('imageProgress')->findOrFail($id);

        return view('pages.karyawan.progress.edit_progress', ['progress' => $progress]);
    }

    public function updateProgress($id, Request $request){
        $progress = ProgressTask::with('imageProgress')->findOrFail($id);

        try {
            $request->validate([
                'deskripsi' => 'required',
                'status' => 'nullable',
                'comment' => 'nullable',
                'image' => 'nullable',
                'image.*' => 'file|mimes:jpeg,png,jpg,pdf'
            ]);

            $progress->deskripsi = $request->deskripsi;
            $progress->status = $request->status;
            $progress->comment = $request->comment;

            $progress->save();

            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $image) {
                    $imagePath = $image->store('progress', 'public');
                    ImageTask::create([
                        'id_progress_task' => $progress->id_progress_task,
                        'image' => $imagePath,
                    ]);
                }
            }
            return redirect()->back()->with('success', 'Sukses ubah data');
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function deleteImage($id){
        try {
            $image = ImageTask::findOrFail($id);

            $image->delete();
            return redirect()->back()->with('success', 'Image deleted successfully');
        } catch (\Throwable $th) {
           return response()->json(['error' => $th->getMessage()]);
        }

    }
}
