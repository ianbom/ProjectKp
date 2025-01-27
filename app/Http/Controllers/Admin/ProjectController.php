<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Admin\ProjectRequest;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

public function index(Client $client)
{
    if (request()->ajax()) {
        $query = Project::query()
            ->where('clients_id', $client->id)
            ->select([
                'id',
                'name',
                'jenis',
                'deadline',
                'status'
            ]);

        return DataTables::of($query)
            ->editColumn('deadline', function ($item) {
                return Carbon::parse($item->deadline)->translatedFormat('j F Y');
            })
            ->addColumn('action', function ($item) {
                return '
                    <div class="btn-group">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">
                                Aksi
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="' . route('project.edit', $item->id) . '">
                                    Edit
                                </a>
                                <form action="' . route('project.destroy', $item->id) . '" method="POST">
                                    ' . method_field('delete') . csrf_field() . '
                                    <button type="submit" class="dropdown-item text-danger">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                ';
            })
            ->rawColumns(['action'])
            ->make();
    }

    return view('pages.admin.project.index', compact('client'));
}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Client $client)
    {
        return view('pages.admin.project.create', compact('client'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request, Client $client)
    {

        $data = $request->all();
        $data['clients_id'] = $client->id;

        $data['photo'] = $request->file('photo')->store('assets/imgproject', 'public');
        $project = Project::create($data);

        Event::create([
            'id_project' => $project->id,
            'title' => $project->name,
            'start' => $project->created_at,
            'end' => $project->deadline
        ]);

        $this->kirimWaClient($client->phone, 'Project anda telah dibuat dan segera dikerjakan oleh developer kami, mohon setia menunggu

        sent by WebCare');

        return redirect()->route('client.project.index', $client->id)->with('success', 'Project created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $item = $project;

        return view('pages.admin.project.edit', [
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $data = $request->all();
        $item = $project;
        if ($request->hasFile('photo')) {

            $data['photo'] = $request->file('photo')->store('assets/imgproject', 'public');
            if ($item->photo) {
                Storage::delete($item->photo);
                File::delete(public_path('storage/' . $item->photo));
            }
        } else {
            $request['photo'] = $item->photo;
        }

        $item = $project;

        $item->update($data);

        $event = Event::where('id_project', $project->id)->first();
        $event->update([
            'title' => $project->name,
            'end' => $project->deadline
        ]);


        if ($item->status == 'Completed') {
            $this->kirimWaClient($item->client->phone, 'Project anda telah selesai, segera kunjungi website anda

            sent by WebCare');

        }

        return redirect()->route('client.project.index', $project->clients_id)->with('success', 'Project updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        File::delete(public_path('storage/' . $project->photo));

        $event = Event::where('id_project', $project->id)->first();
        $event->delete();
        $project->delete();
        return redirect()->back()->with('success', 'Project deleted successfully');
    }

    private function kirimWaClient($target, $message,){
        try {
            $response = Http::withHeaders([
                'Authorization' => env('FONNTE_API_KEY'),
            ])->post('https://api.fonnte.com/send', [
                'target' => $target,
                'message' => $message,

            ]);

            $result = json_decode($response, true);
            // dd($result);

        } catch (\Throwable $th) {
           return response()->json(['error' => $th->getMessage()]);
        }

    }
}
