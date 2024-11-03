@extends('layouts.karyawan')

@section('title', 'Task List')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Daftar Task Karyawan</h4>
        </div>
        <div class="card-body">
            @if($task->isEmpty())
                <p class="text-center">Tidak ada task untuk ditampilkan.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID Task</th>
                                <th>Project</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($task as $item)
                                <tr>
                                    <td>{{ $item->id_task }}</td>
                                    <td>{{ $item->projects->name ?? 'No Project Assigned' }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}</td>
                                    <td>
                                        <a href="{{ route('karyawan.task.detail', $item->id_task) }}" class="btn btn-success">Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
