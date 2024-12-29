@extends('layouts.karyawan')

@section('title', 'Edit Progress Karyawan')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm border-0 mb-5"
        style="border-radius: 7px; background-color: #E8F0FE; transition: transform 0.3s, box-shadow 0.3s;">
        <div class="header" style="background-color: #0B20E9; color: white; border-radius: 8px 8px 0 0;">
            <h6 class="card-title text-left" style="padding-left:50px;" >Edit Progress Karyawan</h6>

        </div>

        <div class="card-body p-5">
            @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>

    @endif
            <form action="{{ route('karyawan.progress.update', $progress->id_progress_task) }}" method="POST" enctype="multipart/form-data"
                style="border: 1px solid #0B20E9; border-radius: 7px; padding: 20px; background-color: #ffffff;">
                @csrf
                @method('PUT')

                <!-- Deskripsi -->
                <div class="form-section mb-5">
                    <h6 class="mb-3" style="color: #0B20E9; font-weight: bold;">Deskripsi Task</h6>
                    <textarea name="deskripsi" id="deskripsi" class="form-control shadow-sm" rows="4"
                        style="border: 1px solid #0B20E9; border-radius: 7px;" required>{{ old('deskripsi', $progress->deskripsi) }}</textarea>
                </div>

                <!-- Status -->
                <div class="form-section mb-5">
                    <h6 class="mb-3" style="color: #0B20E9; font-weight: bold;">Status</h6>
                    <select name="status" id="status" class="form-control shadow-sm"
                        style="border: 1px solid #0B20E9; border-radius: 7px;">
                        <option value="On-Going" {{ $progress->status === 'On-Going' ? 'selected' : '' }}>On-Going</option>
                        <option value="Completed" {{ $progress->status === 'Completed' ? 'selected' : '' }}>Completed</option>
                        <option value="Revisi" {{ $progress->status === 'Revisi' ? 'selected' : '' }}>Revisi</option>
                    </select>
                </div>

                <!-- Komentar -->
                <div class="form-section mb-5">
                    <h6 class="mb-3" style="color: #0B20E9; font-weight: bold;">Komentar</h6>
                    <textarea name="comment" id="comment" class="form-control shadow-sm" rows="4"
                        style="border: 1px solid #0B20E9; border-radius: 7px;">{{ old('comment', $progress->comment) }}</textarea>
                </div>

                <!-- Upload Gambar/PDF -->
                <div class="form-section mb-5">
                    <h6 class="mb-3" style="color: #0B20E9; font-weight: bold;">Upload File</h6>
                    <input type="file" name="image[]" id="image" class="form-control shadow-sm mb-3"
                           style="border: 1px solid #0B20E9; border-radius: 7px; padding: 10px; background-color: #f5f8fd; width: 100%; box-sizing: border-box;"
                           accept=".jpg, .jpeg, .png, .pdf" multiple>
                    <small class="form-text text-muted" style="margin-top: 5px;">Format yang didukung: JPG, PNG, PDF. Anda dapat mengunggah beberapa file.</small>
                </div>



                <!-- Tombol -->
                <div class="text-right mt-5">
                    <button type="submit" class="btn px-5 py-2" style="background-color: #0B20E9; color: white; border-radius: 7px;">
                        Update Progress
                    </button>
                    <a href="{{ route('karyawan.task.detail', $progress->task->id_task) }}" class="btn px-5 py-2 btn-secondary" style="border-radius: 7px;">
                        Cancel
                    </a>
                </div>
            </form>

            <!-- File Saat Ini -->
            <h6 class="mt-5" style="color: #0B20E9;">File yang Ada</h6>
            <div class="row mt-3">
                @foreach ($progress->imageProgress as $image)
                    <div class="col-md-4 mb-3 text-center">
                        @if (pathinfo($image->image, PATHINFO_EXTENSION) === 'pdf')
                            <a href="{{ Storage::url($image->image) }}" target="_blank" class="btn btn-outline-primary mb-2"
                                style="border-radius: 7px;">Download PDF</a>
                        @else
                            <img src="{{ Storage::url($image->image) }}" alt="Progress Image" class="img-fluid rounded"
                                style="max-width: 100%; max-height: 200px; object-fit: cover;">
                        @endif
                        <form action="{{ route('karyawan.imageProgress.delete', $image->id_task_image) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this file?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm mt-2" style="border-radius: 5px; padding: 6px 12px;">Delete</button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Efek Hover dan Fokus -->
<style>
    .header {
        background-color: #0B20E9;
        color: white;
        font-weight: bold;
        padding-bottom: 10px;
        padding-top: 20px;
    }
    .form-control:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .form-control:focus {
        box-shadow: 0 4px 12px rgba(11, 32, 233, 0.2);
        border-color: #0B20E9;
    }

    .btn:hover {
        background-color: #E8F0FE; /* Warna tombol saat hover */
        color: #0B20E9;
        border: 2px solid #0B20E9;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    h2::after {
        content: '';
        display: block;
        width: 60px;
        height: 3px;
        background-color: #0B20E9;
        margin: 8px auto 0;
        border-radius: 2px;
    }
</style>
@endsection
