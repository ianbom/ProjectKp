@extends('layouts.karyawan')

@section('title', 'Task Detail')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<style>
    body {
        background: linear-gradient(to bottom right, #CED2FB, #E8E9FF);
        min-height: 100vh;
        margin: 0;
        padding: 0;
    }
    .card1 {
        border-radius: 10px;
        background-color: #FFFFFF;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    .card {
        background-color: #E8F0FE; /* Warna background card */
        border-radius: 7px;
        box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0px 12px 20px rgba(0, 0, 0, 0.2);
    }

    .btn:hover {
        background-color: #E8F0FE; /* Warna background button */
        color: #0B20E9; /* Warna font button */
        font-weight: 500;
        border: 2px solid #0B20E9;
        border-radius: 7px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s, box-shadow 0.3s;
    }

    .btn {
        background-color: #0B20E9; /* Warna hover button */
        color: #FFFFFF;
        box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.15);
    }

    table {
        border-collapse: separate;
        border-spacing: 0;
        border-radius: 7px;
        background-color: #FFFFFF; /* Warna background tabel */
    }

    table thead {
        background-color: #0B20E9; /* Warna background header tabel */
        color: #FFFFFF; /* Warna font header tabel */
    }

    table tbody tr {
        background-color: #F5F7FF; /* Warna background baris */
        color: #0B20E9; /* Warna font isi tabel */
        transition: background-color 0.3s, color 0.3s;
    }

    table tbody tr:hover {
        background-color: #F2F2F2FF; /* Warna background saat hover */
        color: #818B95; /* Warna font saat hover */
    }

    th, td {
        vertical-align: middle;
        padding: 12px;
        border: 1px solid #E8E9FF;
        text-align: center; /* Rata tengah */
    }

    th {
        font-size: 14px;
        font-weight: bold;
    }

    td {
        font-size: 14px;
    }
    .custom-table {
    width: 100%; /* Makes the table span the full width of the container */
    border-radius: 7px;
    background-color: #ffffff;
    border-collapse: separate;
    border-spacing: 0;
    overflow: hidden;
}

.custom-table th, .custom-table td {
    padding: 10px;
    border: 1px solid #ddd;
}

.custom-table th {
    background-color: #F7F7F7FF;
    text-align: left;
    font-weight: bold;
}

.custom-table td {
    background-color: #ffffff;
    text-align: left;
}
.dropdown-menu {
    right: auto !important;
    left: 0 !important;
}

</style>

<div class="container mt-5">
    <div class="card">
        <div class="card-header" style="background-color: #0B20E9; color:#FFFFFF; padding-top:20px;">
            <h6 class="card-title">Detail Task Karyawan</h6>
        </div>

        <div class="card-body">
            <h6 class=" mb-4" style="color: #0B20E9; font-weight:600;">Informasi Project</h6>

            @if ($task->projects)
            <div class="row">
                <!-- Project Name -->
                <div class="col-md-6 mb-4">
                    <div class="card1 shadow-sm border-0">
                        <div class="card-body">
                            <h6 style="color: #0B20E9; font-weight: bold;">Project Name</h6>
                            <p>{{ $task->projects->name }}</p>
                        </div>
                    </div>
                </div>

                <!-- Jenis -->
                <div class="col-md-6 mb-4">
                    <div class="card1 shadow-sm border-0">
                        <div class="card-body">
                            <h6 style="color: #0B20E9; font-weight: bold;">Jenis</h6>
                            <p>{{ $task->projects->jenis }}</p>
                        </div>
                    </div>
                </div>

                <!-- Keterangan -->
                <div class="col-md-6 mb-4">
                    <div class="card1 shadow-sm border-0">
                        <div class="card-body">
                            <h6 style="color: #0B20E9; font-weight: bold;">Keterangan</h6>
                            <p>{{ $task->projects->keterangan }}</p>
                        </div>
                    </div>
                </div>

                <!-- Deadline -->
                <div class="col-md-6 mb-4">
                    <div class="card1 shadow-sm border-0">
                        <div class="card-body">
                            <h6 style="color: #0B20E9; font-weight: bold;">Deadline</h6>
                            <p>{{ \Carbon\Carbon::parse($task->projects->deadline)->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Status -->
                <div class="col-md-6 mb-4">
                    <div class="card1 shadow-sm border-0">
                        <div class="card-body">
                            <h6 style="color: #0B20E9; font-weight: bold;">Status</h6>
                            <p>{{ $task->projects->status }}</p>
                        </div>
                    </div>
                </div>

                <!-- Masa Aktif -->
                <div class="col-md-6 mb-4">
                    <div class="card1 shadow-sm border-0">
                        <div class="card-body">
                            <h6 style="color: #0B20E9; font-weight: bold;">Masa Aktif</h6>
                            <p>{{ \Carbon\Carbon::parse($task->projects->masaaktif)->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Notes -->
                <div class="col-md-6 mb-4">
                    <div class="card1 shadow-sm border-0">
                        <div class="card-body">
                            <h6 style="color: #0B20E9; font-weight: bold;">Notes</h6>
                            <p>{{ $task->projects->notes }}</p>
                        </div>
                    </div>
                </div>

                <!-- Project Photo -->
                <div class="col-md-6 mb-4">
                    <div class="card1 shadow-sm border-0">
                        <div class="card-body">
                            <h6 style="color: #0B20E9; font-weight: bold;">Project Photo</h6>
                            <a href="#" class="btn btn-outline-info btn-sm">Lihat Foto</a>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div style="background-color: #FFFFFF; border-radius: 7px; padding: 15px; ">
                <p style="margin: 0; color: #0B20E9; font-weight: 400; font-size: 14px;">Tugas ini tidak terhubung dengan project dari klien.</p>
            </div>



            @endif
            <h6 class=" mt-5 mb-3" style="color: #0B20E9; font-weight:600;">Informasi Task</h6>

            <div class="row">
                <!-- Title -->
                <div class="col-md-6 mb-4">
                    <div class="card1 shadow-sm border-0">
                        <div class="card-body">
                            <h6 style="color: #0B20E9; font-weight: bold;">Title</h6>
                            <p>{{ $task->title }}</p>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="col-md-6 mb-4">
                    <div class="card1 shadow-sm border-0">
                        <div class="card-body">
                            <h6 style="color: #0B20E9; font-weight: bold;">Description</h6>
                            <p>{{ $task->description }}</p>
                        </div>
                    </div>
                </div>

                <!-- Created At -->
                <div class="col-md-6 mb-4">
                    <div class="card1 shadow-sm border-0">
                        <div class="card-body">
                            <h6 style="color: #0B20E9; font-weight: bold;">Created At</h6>
                            <p>{{ \Carbon\Carbon::parse($task->created_at)->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <h6 class="mt-5 mb-4" style="color: #0B20E9; font-weight:600;">Progress Task</h6>            <div class="row" >
                @forelse ($task->imageTask as $image)
                    <div class="col-md-3 mb-4">
                        <div class="card shadow-sm border-0" style="background-color: #FFFFFF";>
                            <div class="card-body text-center">
                                @if (pathinfo($image->image, PATHINFO_EXTENSION) === 'pdf')
                                    <p class="text-center text-muted">{{ basename($image->image) }}</p>
                                    <a href="{{ Storage::url($image->image) }}" target="_blank" class="btn btn-outline-primary mt-2">
                                        <i class="fas fa-file-pdf"></i> Download PDF
                                    </a>
                                @else
                                    <img src="{{ Storage::url($image->image) }}" alt="Task Image" class="img-fluid rounded" style="max-height: 200px; object-fit: cover;">
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center col-12">Tidak ada gambar untuk task ini.</p>
                @endforelse
            </div>

            <h6 class="mt-3 mb-3" style="color: #0B20E9; font-weight:600;">Progress Task</h6>

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
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        Actions
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                        <li><a class="dropdown-item" href="{{ route('karyawan.progress.detail', $progress->id_progress_task) }}">Detail</a></li>
                                        <li><a class="dropdown-item" href="{{ route('karyawan.progress.edit', $progress->id_progress_task) }}">Edit</a></li>
                                    </ul>
                                </div>
                            </td>



                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada progress untuk task ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <a href="{{ route('karyawan.progress.create', $task->id_task) }}" class="btn btn-success mt-3">Buat Progress</a>

        </div>
    </div>
</div>
@endsection
