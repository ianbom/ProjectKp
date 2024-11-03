@extends('layouts.admin1')

@section('title', 'Task List')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h1> Admin Detail Task </h1>
        </div>
        <div class="card-body">

            <h5 class="mt-5 mb-3">Informasi Project</h5>

            @if ($task->projects)
                <table class="table table-bordered">
                    <tr>
                        <th>Project Name</th>
                        <td>{{ $task->projects->name }}</td>
                    </tr>
                    <tr>
                        <th>Jenis</th>
                        <td>{{ $task->projects->jenis }}</td>
                    </tr>
                    <tr>
                        <th>Keterangan</th>
                        <td>{{ $task->projects->keterangan }}</td>
                    </tr>
                    <tr>
                        <th>Deadline</th>
                        <td>{{ \Carbon\Carbon::parse($task->projects->deadline)->format('d/m/Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>{{ $task->projects->status }}</td>
                    </tr>
                    <tr>
                        <th>Masa Aktif</th>
                        <td>{{ \Carbon\Carbon::parse($task->projects->masaaktif)->format('d/m/Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Notes</th>
                        <td>{{ $task->projects->notes }}</td>
                    </tr>
                    <tr>
                        <th>Project Photo</th>
                        <td>
                            <a href=""> Ini foto project</a>
                        </td>
                    </tr>
                </table>
            @else
                <p>Tugas ini tidak terhubung dengan project dari klien</p>
            @endif

            <h5 class="mb-3">Informasi Task</h5>
            <table class="table table-bordered">
                <tr>
                    <th>Title</th>
                    <td>{{ $task->title }}</td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td>{{ $task->description }}</td>
                </tr>
                <tr>
                    <th>Created At</th>
                    <td>{{ \Carbon\Carbon::parse($task->created_at)->format('d/m/Y H:i') }}</td>
                </tr>
            </table>

            <h5 class="mt-5 mb-3">Task Images</h5>
<div class="row">
    @forelse ($task->imageTask as $image)
        <div class="col-3 m-2">
            @if (pathinfo($image->image, PATHINFO_EXTENSION) === 'pdf')
                <!-- Tampilkan Tombol Download untuk PDF -->
                <p>{{ basename($image->image) }}</p>
                <a href="{{ Storage::url($image->image) }}" target="_blank" class="btn btn-primary">
                    Download PDF
                </a>
            @else
                <!-- Tampilkan Gambar -->
                <img src="{{ Storage::url($image->image) }}" alt="Task Image" class="img-fluid" width="200">
            @endif
        </div>
    @empty
        <p>Tidak ada gambar untuk task ini.</p>
    @endforelse
</div>


            <h5 class="mt-5 mb-3">Progress Task</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                        <th>Comment</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($task->progressTask as $index => $progress)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $progress->deskripsi }}</td>
                            <td>{{ $progress->status }}</td>
                            <td>{{ $progress->comment ?? 'N/A' }}</td>
                            <td>{{ \Carbon\Carbon::parse($progress->created_at)->format('d/m/Y H:i') }}</td>
                            <td>
                                <a class="btn btn-info" href="{{ route('task.detail.progress', $progress->id_progress_task) }}">Detail</a>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada progress untuk task ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- <a href="{{ route('karyawan.progress.create', $task->id_task) }}" class="btn btn-success mt-3">Buat Progress</a> --}}
        </div>
    </div>
</div>
@endsection


