@extends('layouts.admin1')

@section('title', 'Task List')

@section('content')
<style>
    .btn {
            background-color: #0B20E9; /* Warna tombol */
            color: #FFFFFF;
            font-weight: 500;
            border: none;
            border-radius: 7px;
            padding: 10px 20px;
            box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.15);
            transition: background-color 0.3s, color 0.3s, box-shadow 0.3s;
        }

        .btn:hover {
            background-color: #E8F0FE; /* Warna tombol saat hover */
            color: #0B20E9;
            border: 2px solid #0B20E9;
        }
</style>

<div class="container mt-5">
    <div class="card shadow-sm border-0" style="border-radius: 10px; background-color: #E8F0FE;">
        <div class="card-header" style="background-color: #0B20E9; color: white; border-radius: 10px 10px 0 0;">
            <h2 class="text-center font-weight-700 mb-0">Admin Detail Task</h2>
        </div>
        <div class="card-body p-5">

            <!-- Informasi Project -->
            <h5 class="mb-4" style="color: #0B20E9; font-weight: bold;">Informasi Project</h5>
            @if ($task->projects)
                <div class="row">
                    <!-- Project Information Card -->
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm border-0" style="border-radius: 10px; background-color: #FFFFFF;">
                            <div class="card-body">
                                <h6 style="color: #0B20E9; font-weight: bold;">Project Name</h6>
                                <p>{{ $task->projects->name }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm border-0" style="border-radius: 10px; background-color: #FFFFFF;">
                            <div class="card-body">
                                <h6 style="color: #0B20E9; font-weight: bold;">Jenis</h6>
                                <p>{{ $task->projects->jenis }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Keterangan Card -->
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm border-0" style="border-radius: 10px; background-color: #FFFFFF;">
                            <div class="card-body">
                                <h6 style="color: #0B20E9; font-weight: bold;">Keterangan</h6>
                                <p>{{ $task->projects->keterangan }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Deadline and Status Cards -->
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm border-0" style="border-radius: 10px; background-color: #FFFFFF;">
                            <div class="card-body">
                                <h6 style="color: #0B20E9; font-weight: bold;">Deadline</h6>
                                <p>{{ \Carbon\Carbon::parse($task->projects->deadline)->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm border-0" style="border-radius: 10px; background-color: #FFFFFF;">
                            <div class="card-body">
                                <h6 style="color: #0B20E9; font-weight: bold;">Status</h6>
                                <p>{{ $task->projects->status }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Masa Aktif and Notes Cards -->
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm border-0" style="border-radius: 10px; background-color: #FFFFFF;">
                            <div class="card-body">
                                <h6 style="color: #0B20E9; font-weight: bold;">Masa Aktif</h6>
                                <p>{{ \Carbon\Carbon::parse($task->projects->masaaktif)->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm border-0" style="border-radius: 10px; background-color: #FFFFFF;">
                            <div class="card-body">
                                <h6 style="color: #0B20E9; font-weight: bold;">Notes</h6>
                                <p>{{ $task->projects->notes }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Project Photo Card -->
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm border-0" style="border-radius: 10px; background-color: #FFFFFF;">
                            <div class="card-body">
                                <h6 style="color: #0B20E9; font-weight: bold;">Project Photo</h6>
                                <a href="#" class="btn btn-outline-info btn-sm">Lihat Foto</a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <p class="text-center">Tugas ini tidak terhubung dengan project dari klien.</p>
            @endif


            <!-- Informasi Task -->
            <h5 class="mb-4 mt-5    " style="color: #0B20E9; font-weight: bold;">Informasi Task</h5>
            <div class="row">
                <!-- Task Title Card -->
                <div class="col-md-12 mb-4">
                    <div class="card shadow-sm border-0" style="border-radius: 10px; background-color: #FFFFFF;">
                        <div class="card-body">
                            <h6 style="color: #0B20E9; font-weight: bold;">Title</h6>
                            <p>{{ $task->title }}</p>
                        </div>
                    </div>
                </div>

                <!-- Task Description Card -->
                <div class="col-md-12 mb-4">
                    <div class="card shadow-sm border-0" style="border-radius: 10px; background-color: #FFFFFF;">
                        <div class="card-body">
                            <h6 style="color: #0B20E9; font-weight: bold;">Description</h6>
                            <p>{{ $task->description }}</p>
                        </div>
                    </div>
                </div>

                <!-- Task Created At Card -->
                <div class="col-md-12 mb-4">
                    <div class="card shadow-sm border-0" style="border-radius: 10px; background-color: #FFFFFF;">
                        <div class="card-body">
                            <h6 style="color: #0B20E9; font-weight: bold;">Created At</h6>
                            <p>{{ \Carbon\Carbon::parse($task->created_at)->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Task Images -->
            <h5 class="mt-5 mb-4" style="color: #0B20E9; font-weight: bold;">Task Images</h5>
            <div class="row mb-5">
                @forelse ($task->imageTask as $image)
                    <div class="col-md-3 mb-4">
                        <!-- Card for each image -->
                        <div class="card shadow-sm border-0 rounded">
                            <div class="card-body text-center">
                                @if (pathinfo($image->image, PATHINFO_EXTENSION) === 'pdf')
                                    <!-- PDF Display Card -->
                                    <p class="text-center text-muted">{{ basename($image->image) }}</p>
                                    <a href="{{ Storage::url($image->image) }}" target="_blank" class="btn btn-outline-primary mt-2">
                                        <i class="fas fa-file-pdf"></i> Download PDF
                                    </a>
                                @else
                                    <!-- Image Display Card -->
                                    <img src="{{ Storage::url($image->image) }}" alt="Task Image" class="img-fluid rounded" style="max-height: 200px; object-fit: cover;">
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center col-12">Tidak ada gambar untuk task ini.</p>
                @endforelse
            </div>

            <!-- Progress Task -->
            <h5 class="mt-5 mb-4" style="color: #0B20E9; font-weight: bold;">Progress Task</h5>
            <div class="table-responsive">
                <table class="table table-bordered" style="background-color: #FFFFFF; border-radius: 7px;">
                    <thead style="background-color: #0B20E9; color: #E8F0FE;">
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
                                    <a class="btn btn-sm" href="{{ route('task.detail.progress', $progress->id_progress_task) }}">Detail</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada progress untuk task ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
