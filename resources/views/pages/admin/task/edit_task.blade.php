@extends('layouts.admin1')

@section('title', 'Edit Task')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-10">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow-sm border-0 mb-5" style="border-radius: 7px; background-color: #E8F0FE; transition: transform 0.3s, box-shadow 0.3s;">
            <div class="card-body p-5">
                <!-- Title -->
                <h2 class="font-weight-bold mb-4 text-center" style="color: #0B20E9;">Edit Tugas</h2>

                <!-- Task Information Section -->
                <div class="mb-4 mt-5" style="color: #4A4A4A; font-size: 14px; line-height: 1.6; border-left: 4px solid #0B20E9; padding-left: 15px; background-color: #FFFFFF; border-radius: 7px; box-shadow: 0 4px 7px rgba(0, 0, 0, 0.02);">
                    <p>
                        Pastikan detail tugas diperbarui dengan benar. Periksa kembali pemilihan proyek dan pengguna sebelum memperbarui.
                    </p>
                </div>

                <!-- Form Start -->
                <form action="{{ route('task.update', $task->id_task) }}" method="POST" enctype="multipart/form-data" style="border: 1px solid #0B20E9; border-radius: 7px; padding: 20px; background-color: #ffffff;">
                    @method('PUT')
                    @csrf

                    <!-- Project Selection -->
                    <div class="form-section mb-5">
                        <h5 class="mb-3" style="color: #0B20E9; font-weight: bold;">Detail Proyek</h5>
                        <div class="form-group mb-4">
                            <label for="id_projects" style="font-weight: 600;">Pilih Proyek</label>
                            <select class="form-select shadow-sm" id="id_projects" name="id_projects" style="border: 1px solid #0B20E9; border-radius: 7px;" required>
                                <option value="">Tidak Ada Proyek</option>
                                @foreach($projects as $project)
                                    <option value="{{ $project->id }}" {{ $task->id_projects == $project->id ? 'selected' : '' }}>
                                        {{ $project->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- User ID Selection -->
                    <div class="form-section mb-5">
                        <h5 class="mb-3" style="color: #0B20E9; font-weight: bold;">Informasi Pengguna</h5>
                        <div class="form-group mb-4">
                            <label for="id" style="font-weight: 600;">ID Pengguna</label>
                            <select class="form-select shadow-sm" id="id" name="id" style="border: 1px solid #0B20E9; border-radius: 7px;" required>
                                @foreach($user as $u)
                                    <option value="{{ $u->id }}" {{ $task->id == $u->id ? 'selected' : '' }}>
                                        {{ $u->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Title Input -->
                    <div class="form-section mb-5">
                        <h5 class="mb-3" style="color: #0B20E9; font-weight: bold;">Judul Tugas</h5>
                        <div class="form-group mb-4">
                            <label for="title" style="font-weight: 600;">Judul</label>
                            <input type="text" name="title" id="title" class="form-control shadow-sm" style="border: 1px solid #0B20E9; border-radius: 7px;" value="{{ $task->title }}" required>
                        </div>
                    </div>

                    <!-- Description Input -->
                    <div class="form-section mb-5">
                        <h5 class="mb-3" style="color: #0B20E9; font-weight: bold;">Deskripsi Tugas</h5>
                        <div class="form-group mb-4">
                            <label for="description" style="font-weight: 600;">Deskripsi</label>
                            <textarea class="form-control shadow-sm" id="description" name="description" rows="3" style="border: 1px solid #0B20E9; border-radius: 7px;" required>{{ $task->description }}</textarea>
                        </div>
                    </div>

                    <!-- Image Upload Section -->
                    <div class="form-section mb-5">
                        <h5 class="mb-3" style="color: #0B20E9; font-weight: bold;">Unggah Gambar</h5>
                        <div class="form-group mb-4">
                            <label for="image" style="font-weight: 600;">Unggah Gambar Baru</label>
                            <input type="file" class="form-control shadow-sm" id="image" name="image[]" multiple style="border: 1px solid #0B20E9; border-radius: 7px;">
                            <small class="text-muted">Anda dapat mengunggah beberapa gambar. Format yang diperbolehkan: jpeg, png, jpg, pdf.</small>
                        </div>
                    </div>

                    <!-- Current Images Section -->
                    <div class="mb-3">
                        <label for="current_images" class="form-label" style="font-weight: 600;">Gambar Saat Ini</label>
                        <div class="d-flex flex-wrap">
                            @if($task->imageTask && $task->imageTask->isNotEmpty())
                                @foreach($task->imageTask as $image)
                                    <div class="m-2">
                                        @if(pathinfo($image->image, PATHINFO_EXTENSION) === 'pdf')
                                            <p>{{ $image->image }}</p>
                                            <a href="{{ asset('storage/' . $image->image) }}" target="_blank" class="btn btn-primary btn-sm">Unduh PDF</a>
                                        @else
                                            <img src="{{ asset('storage/' . $image->image) }}" alt="Gambar Tugas" width="100" height="100" style="object-fit: cover; border-radius: 7px;">
                                        @endif
                                        <!-- Delete Button Below Image -->
                                        <form action="{{ route('image.task.delete', $image->id_task_image) }}" method="POST" class="mt-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </div>
                                @endforeach
                            @else
                                <p>Tidak ada gambar tersedia</p>
                            @endif
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="text-right mt-5">
                        <button type="submit" class="btn px-5 py-2" style="background-color: #0B20E9; color: #fff;">Simpan</button>
                        <a href="{{ route('task.index') }}" class="btn px-5 py-2 btn-secondary" style="background-color: #E8F0FE; border: 2px solid #0B20E9; color:#0B20E9">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .form-control:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .form-control:focus {
        box-shadow: 0 4px 12px rgba(11, 32, 233, 0.2);
        border-color: #0B20E9;
    }

    .btn:hover {
        background-color: #E8F0FE;
        color: #0B20E9;
        border: 2px solid #0B20E9;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    h2 {
        position: relative;
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
