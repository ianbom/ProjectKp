@extends('layouts.karyawan')

@section('title', 'Create Progress Task')

@section('content')
<head>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>
<div class="container mt-5">
    <div class="card shadow-sm border-0 mb-5"
        style="border-radius: 7px; background-color: #E8F0FE; transition: transform 0.3s, box-shadow 0.3s;">
        <div class="header" style="background-color: #0B20E9; color: white; border-radius: 8px 8px 0 0;">
            <h6 class="card-title text-left" style="padding-left:50px;">Tambah Progress untuk Task: {{ $task->title }}</h6>
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

            <form action="{{ route('karyawan.progress.store', $task->id_task) }}" method="POST" enctype="multipart/form-data"
                style="border: 1px solid #0B20E9; border-radius: 7px; padding: 20px; background-color: #ffffff;">
                @csrf

                <!-- Task ID (No style change, keeping it functional) -->
                <div class="form-section mb-5">
                    <h6 class="mb-3" style="color: #0B20E9; font-weight: bold;">Task ID</h6>
                    <input type="text" class="form-control shadow-sm" id="id_task" name="id_task" value="{{ $task->id_task }}" readonly
                        style="border: 1px solid #0B20E9; border-radius: 7px; padding: 10px; background-color: #f5f8fd;">
                </div>

                <input type="hidden" name="id" value="{{ Auth::id() }}">

                <!-- Deskripsi -->
                <div class="form-section mb-5">
                    <h6 class="mb-3" style="color: #0B20E9; font-weight: bold;">Deskripsi Progress</h6>
                    <textarea name="deskripsi" id="deskripsi" class="form-control shadow-sm" rows="4"
                        style="border: 1px solid #0B20E9; border-radius: 7px;"  placeholder="Masukkan deskripsi pengerjaan yang telah dilakukan" required>{{ old('deskripsi') }}</textarea>
                </div>

                <!-- Status (Dropdown) -->
                <div class="form-section mb-5">
                    <h6 class="mb-3" style="color: #0B20E9; font-weight: bold;">Status</h6>
                    <select name="status" class="form-control shadow-sm" style="border: 1px solid #0B20E9; border-radius: 7px;">
                        <option value="On-Going" selected>On-Going</option>
                        <option value="Completed">Completed</option>
                        <option value="Pending">Pending</option>
                    </select>
                </div>

                <!-- Upload Gambar/PDF -->

                <div class="form-group mb-4">
                    <label for="image" style="font-weight: 600;">Upload Gambar</label>
                    <input type="file" name="image[]" id="image" class="form-control shadow-sm"
                        style="border: 1px solid #0B20E9; border-radius: 7px; padding: 10px; background-color: #f5f8fd;" multiple
                        accept="image/jpeg,image/png,application/pdf" multiple>
                    <small class="form-text text-muted">Anda bisa menambahkan banyak File. Format yang didukung: JPG, PNG, PDF. Setiap File Maks 3 MB </small>
                </div>

                <!-- Tombol -->
                <div class="text-right mt-5">
                    <button type="submit" class="btn px-5 py-2" style="background-color: #0B20E9; color: white; border-radius: 7px;">
                        Simpan Progress
                    </button>
                    <a href="{{ route('karyawan.task.index') }}" class="btn px-5 py-2 btn-secondary" style="border-radius: 7px;">
                        Kembali
                    </a>
                </div>
            </form>
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

@endsection

