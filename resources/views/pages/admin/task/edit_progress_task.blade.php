@extends('layouts.admin1')

@section('title', 'Task List')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
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

            <!-- Card Utama -->
            <div class="card shadow-sm border-0 mb-5"
                style="border-radius: 7px; background-color: #E8F0FE; transition: transform 0.3s, box-shadow 0.3s;">
                <div class="card-body p-5">
                    <!-- Judul -->
                    <h2 class="font-weight-bold mb-4 text-center" style="color: #0B20E9;">Edit Progress Task</h2>

                    <!-- Penjelasan -->
                    <div class="mb-4"
                        style="color: #4A4A4A; font-size: 14px; line-height: 1.6; border-left: 4px solid #0B20E9; padding-left: 15px;
                                background-color: #FFFFFF; border-radius: 7px; box-shadow: 0 4px 7px rgba(0, 0, 0, 0.02);">
                        <p>
                            Perbarui informasi progress task sesuai kebutuhan. Pastikan semua data yang diisi sudah benar dan valid.
                        </p>
                    </div>

                    <!-- Formulir -->
                    <form action="{{ route('task.detail.update', $progress->id_progress_task) }}" method="POST" enctype="multipart/form-data"
                        style="border: 1px solid #0B20E9; border-radius: 7px; padding: 20px; background-color: #ffffff;">
                        @csrf
                        @method('PUT')

                        <!-- Deskripsi -->
                        <div class="form-section mb-5">
                            <h5 class="mb-3" style="color: #0B20E9; font-weight: bold;">Deskripsi Task</h5>
                            <textarea name="deskripsi" id="deskripsi" class="form-control shadow-sm" rows="4"
                                style="border: 1px solid #0B20E9; border-radius: 7px;" disabled>{{ old('deskripsi', $progress->deskripsi) }}</textarea>
                        </div>

                        <!-- Status -->
                        <div class="form-section mb-5">
                            <h5 class="mb-3" style="color: #0B20E9; font-weight: bold;">Status</h5>
                            <select name="status" id="status" class="form-control shadow-sm"
                                style="border: 1px solid #0B20E9; border-radius: 7px;">
                                <option value="On-Going" {{ $progress->status === 'On-Going' ? 'selected' : '' }}>On-Going</option>
                                <option value="Completed" {{ $progress->status === 'Completed' ? 'selected' : '' }}>Completed</option>
                                <option value="Revisi" {{ $progress->status === 'Revisi' ? 'selected' : '' }}>Revisi</option>
                            </select>
                        </div>

                        <!-- Komentar -->
                        <div class="form-section mb-5">
                            <h5 class="mb-3" style="color: #0B20E9; font-weight: bold;">Komentar</h5>
                            <textarea name="comment" id="comment" class="form-control shadow-sm" rows="4"
                                style="border: 1px solid #0B20E9; border-radius: 7px;">{{ old('comment', $progress->comment) }}</textarea>
                        </div>

                        <!-- Upload Gambar/PDF -->
                        <div class="form-section mb-5">
                            <h5 class="mb-3" style="color: #0B20E9; font-weight: bold;">Upload File</h5>
                            <input type="file" name="image[]" id="image" class="form-control shadow-sm"
                                style="border: 1px solid #0B20E9; border-radius: 7px;" accept=".jpg, .jpeg, .png, .pdf" multiple disabled>
                            <small class="form-text text-muted">Format yang didukung: JPG, PNG, PDF. Anda dapat mengunggah beberapa file.</small>
                        </div>

                        <!-- File Saat Ini -->
                        <h5 class="mt-5" style="color: #0B20E9;">File yang Ada</h5>
                        <div class="row mt-3">
                            @foreach ($progress->imageProgress as $image)
                                <div class="col-md-4 mb-3 text-center">
                                    @if (pathinfo($image->image, PATHINFO_EXTENSION) === 'pdf')
                                        <a href="{{ Storage::url($image->image) }}" target="_blank" class="btn btn-outline-primary mb-2">Download PDF</a>
                                    @else
                                        <img src="{{ Storage::url($image->image) }}" alt="Progress Image" class="img-thumbnail"
                                            style="max-width: 200px; border-radius: 7px;">
                                    @endif
                                    <form action="{{ route('karyawan.imageProgress.delete', $image->id_task_image) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this file?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm mt-2" hidden>Delete</button>
                                    </form>
                                </div>
                            @endforeach
                        </div>

                        <!-- Tombol -->
                        <div class="text-right mt-5">
                            <button type="submit" class="btn px-5 py-2">
                                Update Progress
                            </button>
                            <a href="{{ route('task.detail', $progress->task->id_task) }}" class="btn px-5 py-2 btn-secondary">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Efek Hover dan Fokus -->
    <style>
        .form-control:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .form-control:focus {
            box-shadow: 0 4px 12px rgba(11, 32, 233, 0.2);
            border-color: #0B20E9;
        }

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
