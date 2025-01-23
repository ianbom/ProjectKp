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
            <div class="header" style="background-color: #0B20E9; color: white; border-radius: 8px 8px 0 0;">
                <p class="card-title text-left" style="padding-left:50px;">Edit Tugas</p>
            </div>

            <div class="card-body p-5">
                <!-- Task Information Section -->
                <div class="" style="color: #4A4A4A; font-size: 14px; line-height: 3;
                border-left: 4px solid #0B20E9; padding-left: 15px; background-color: #FFFFFF; border-radius: 7px; box-shadow: 0 4px 7px rgba(0, 0, 0, 0.02); margin-top:2px; margin-bottom: 2 px;
                ">
                    <p >
                        Pastikan detail tugas diperbarui dengan benar. Periksa kembali pemilihan proyek dan pengguna sebelum memperbarui.
                    </p>
                </div>

                <!-- Form Start -->
                <form action="{{ route('task.update', $task->id_task) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf

                    <div class="form" style="border: 1px solid #0B20E9; border-radius: 7px; padding: 20px; background-color: #ffffff;">
                        <!-- Project Selection -->
                    {{-- <div class="form-section mb-5">
                        <h6 class="mb-3" style="color: #0B20E9; font-weight: bold;">Detail Proyek</h6>
                        <div class="form-group mb-4">
                            <label for="id_projects" style="font-weight: 600;">Pilih Proyek</label>
                            <select class="form-control shadow-sm" id="id_projects" name="id_projects" style="border: 1px solid #0B20E9; border-radius: 7px; padding: 10px; background-color: #f5f8fd;" required>
                                <option value="">Tidak Ada Proyek</option>
                                @foreach($projects as $project)
                                    <option value="{{ $project->id }}" {{ $task->id_projects == $project->id ? 'selected' : '' }}>
                                        {{ $project->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}
                    <div class="form-section">
                        <h6 class="mb-3" style="color: #0B20E9; font-weight: bold;">Detail Proyek</h6>
                        <div class="form-group mb-4">
                            <label for="id_projects" style="font-weight: 600;">Pilih Proyek</label>
                            <select name="id_projects" id="id_projects" class="js-example-basic-single1 form-control shadow-sm"
                                style="border: 1px solid #0B20E9; border-radius: 7px; padding: 10px; background-color: #f5f8fd;">
                                <option value="">Tidak Ada</option>
                                @foreach($projects as $project)
                                <option value="{{ $project->id }}" {{ $task->id_projects == $project->id ? 'selected' : '' }}>
                                    {{ $project->name }}
                                </option>
                            @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- User ID Selection -->
                    {{-- <div class="form-section mb-5">
                        <h6 class="mb-3" style="color: #0B20E9; font-weight: bold;">Informasi Pengguna</h6>
                        <div class="form-group mb-4">
                            <label for="id" style="font-weight: 600;">ID Pengguna</label>
                            <select class="form-control shadow-sm" id="id" name="id" style="border: 1px solid #0B20E9; border-radius: 7px; padding: 10px; background-color: #f5f8fd;" required>
                                @foreach($user as $u)
                                    <option value="{{ $u->id }}" {{ $task->id == $u->id ? 'selected' : '' }}>
                                        {{ $u->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}
                    <div class="form-section mb-5">
                        <h6 class="mb-3" style="color: #0B20E9; font-weight: bold;">Informasi Pengguna</h6>
                        <div class="form-group mb-4">
                            <label for="id" style="font-weight: 600;">ID Pengguna</label>
                        <select name="user" class="js-example-basic-single form-control shadow-sm"
                            style="border: 1px solid #0B20E9; border-radius: 7px; padding: 10px; background-color: #f5f8fd;" required>
                            <option value="">Pilih Pengguna</option>
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
                        <h6 class="mb-3" style="color: #0B20E9; font-weight: bold;">Judul Tugas</h6>
                        <div class="form-group mb-4">
                            <label for="title" style="font-weight: 600;">Judul</label>
                            <input type="text" name="title" id="title" class="form-control shadow-sm" style="border: 1px solid #0B20E9; border-radius: 7px; padding: 10px; background-color: #f5f8fd;" value="{{ $task->title }}" required>
                        </div>
                    </div>

                    <div class="form-section mb-5">
                        <h6 class="mb-3" style="color: #0B20E9; font-weight: bold;">Status</h6>
                        <select name="status" class="form-control shadow-sm" style="border: 1px solid #0B20E9; border-radius: 7px;">
                            <option value="On-Going" {{ old('status', $task->status) == 'On-Going' ? 'selected' : '' }}>On-Going</option>
                            <option value="Completed" {{ old('status', $task->status) == 'Completed' ? 'selected' : '' }}>Completed</option>
                            <option value="On-Check" {{ old('status', $task->status) == 'On-Check' ? 'selected' : '' }}>On-Check</option>
                        </select>
                    </div>


                    <!-- Description Input -->
                    <div class="form-section mb-5">
                        <h6 class="mb-3" style="color: #0B20E9; font-weight: bold;">Deskripsi Tugas</h6>
                        <div class="form-group mb-4">
                            <label for="description" style="font-weight: 600;">Deskripsi</label>
                            <textarea class="form-control shadow-sm" id="description" name="description" rows="3" style="border: 1px solid #0B20E9; border-radius: 7px; padding: 10px; background-color: #f5f8fd;" required>{{ $task->description }}</textarea>
                        </div>
                    </div>

                    <!-- Image Upload Section -->
                    <div class="form-section mb-5">
                        <h6 class="mb-3" style="color: #0B20E9; font-weight: bold;">Unggah Gambar</h6>
                        <div class="form-group mb-4">
                            <label for="image" style="font-weight: 600;">Unggah Gambar Baru</label>
                            <input type="file" class="form-control shadow-sm" id="image" name="image[]" multiple style="border: 1px solid #0B20E9; border-radius: 7px; padding: 10px; background-color: #f5f8fd;">
                            <small class="form-text text-muted">Anda bisa menambahkan banyak File. Format yang didukung: JPG, PNG, PDF. Setiap File Maks 3 MB </small>
                        </div>
                    </div>


                    <!-- Action Buttons -->
                    <div class="text-right mt-5">
                        <button type="submit" class="btn px-5 py-2" style="background-color: #0B20E9; color: white; border-radius: 7px;">
                            Simpan
                        </button>
                        <a href="{{ route('task.index') }}" class="btn px-5 py-2 btn-secondary" style="background-color: #E8F0FE; border: 2px solid #0B20E9; color:#0B20E9">
                            Batal
                        </a>
                    </div>
                    </form>

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


                </div>


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

    h6 {
        font-size: 18px;
        font-weight: bold;
    }
    .header {
        background-color: #0B20E9;
        color: white;
        font-weight: bold;
        padding-bottom: 10px;
        padding-top: 20px;
    }
</style>
<script>
    document.getElementById('image').addEventListener('change', function(event) {
        const files = event.target.files;
        const maxSize = 3 * 1024 * 1024; // 3 MB
        const allowedExtensions = ['jpg', 'jpeg', 'png', 'pdf'];
        let isValid = true;

        for (let file of files) {
            const fileExtension = file.name.split('.').pop().toLowerCase();
            if (!allowedExtensions.includes(fileExtension)) {
                alert(`Format file ${file.name} tidak didukung. Hanya JPG, PNG, dan PDF yang diizinkan.`);
                isValid = false;
            }

            if (file.size > maxSize) {
                alert(`Ukuran file ${file.name} melebihi 3 MB.`);
                isValid = false;
            }
        }

        if (!isValid) {
            event.target.value = ''; // Reset input file jika ada file tidak valid
        }
    });
    </script>
    @push('addon-script')


    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2({
                placeholder: "Pilih Pengguna",
                allowClear: true
            });

        $(document).ready(function() {
            $('.js-example-basic-single1').select2({
                placeholder: "Pilih Proyek",
                allowClear: true
            });
        }); });
    </script>
    @endpush
@endsection
