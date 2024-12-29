@extends('layouts.admin1')

@section('title')
    Create Task
@endsection

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

            <div class="card shadow-sm border-0 mb-5"
                style="border-radius: 7px; background-color: #E8F0FE; transition: transform 0.3s, box-shadow 0.3s;">
                <div class="header" style="background-color: #0B20E9; color: white; border-radius: 8px 8px 0 0;">
                    <p class="card-title text-left" style="padding-left:50px;">Tambah Taks Baru</p>
                </div>


                <div class="card-body p-5">
                    <!-- Penjelasan -->
                    <div class="mb-4"
                        style="color: #4A4A4A; font-size: 14px; line-height: 1.6; border-left: 4px solid #0B20E9; padding-left: 15px;
                                background-color: #FFFFFF; border-radius: 7px; box-shadow: 0 4px 7px rgba(0, 0, 0, 0.02);">
                        <p>
                            Isi informasi task dengan lengkap dan jelas. Data ini akan membantu dalam manajemen task dan alur pekerjaan yang lebih efisien.
                        </p>
                    </div>

                    <!-- Formulir -->
                    <form action="{{ route('task.store') }}" method="POST" enctype="multipart/form-data"
                        style="border: 1px solid #0B20E9; border-radius: 7px; padding: 20px; background-color: #ffffff;">
                        @csrf

                        <!-- Pilih Proyek (Optional) -->
                        <div class="form-section mb-5">
                            <h6 class="mb-3" style="color: #0B20E9; font-weight: bold;">Pilih Project (Opsional)</h6>
                            <div class="form-group mb-4">
                                <label for="id_projects" style="font-weight: 600;">Project</label>
                                <select name="id_projects" id="id_projects" class="form-control shadow-sm"
                                    style="border: 1px solid #0B20E9; border-radius: 7px; padding: 10px; background-color: #f5f8fd;">
                                    <option value="">Tidak Ada</option>
                                    @foreach($projects as $project)
                                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Pilih Pengguna (Required) -->
                        <div class="form-section mb-5">
                            <h6 class="mb-3" style="color: #0B20E9; font-weight: bold;">Penugasan Pengguna</h6>
                            <div class="form-group mb-4">
                                <label for="id" style="font-weight: 600;">Pilih Pengguna</label>
                                <select name="id" id="id" class="form-control shadow-sm"
                                    style="border: 1px solid #0B20E9; border-radius: 7px; padding: 10px; background-color: #f5f8fd;" required>
                                    <option value="">Pilih Pengguna</option>
                                    @foreach($user as $u)
                                        <option value="{{ $u->id }}">{{ $u->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Judul Tugas (Required) -->
                        <div class="form-section mb-5">
                            <h6 class="mb-3" style="color: #0B20E9; font-weight: bold;">Judul Task</h6>
                            <div class="form-group mb-4">
                                <label for="title" style="font-weight: 600;">Judul Task</label>
                                <input type="text" name="title" id="title" class="form-control shadow-sm"
                                    style="border: 1px solid #0B20E9; border-radius: 7px; padding: 10px; background-color: #f5f8fd;"
                                    placeholder="Masukkan judul tugas" required>
                            </div>
                        </div>

                        <!-- Deskripsi Tugas (Required) -->
                        <div class="form-section mb-5">
                            <h6 class="mb-3" style="color: #0B20E9; font-weight: bold;">Deskripsi Task</h6>
                            <div class="form-group mb-4">
                                <label for="description" style="font-weight: 600;">Deskripsi Task</label>
                                <textarea name="description" id="description" class="form-control shadow-sm"
                                    style="border: 1px solid #0B20E9; border-radius: 7px; padding: 10px; background-color: #f5f8fd;"
                                    rows="5" placeholder="Masukkan deskripsi tugas" required></textarea>
                            </div>
                        </div>

                        <!-- Upload Gambar (Optional) -->
                        <div class="form-section mb-5">
                            <h6 class="mb-3" style="color: #0B20E9; font-weight: bold;">Unggah Gambar</h6>
                            <div class="form-group mb-4">
                                <label for="image" style="font-weight: 600;">Upload Gambar</label>
                                <input type="file" name="image[]" id="image" class="form-control shadow-sm"
                                    style="border: 1px solid #0B20E9; border-radius: 7px; padding: 10px; background-color: #f5f8fd;" multiple
                                    accept="image/jpeg,image/png,application/pdf">
                                <small class="form-text text-muted" style="margin-top: 5px;">Format yang didukung: JPG, PNG, PDF. Pastikan ukuran file sesuai ketentuan.</small>
                            </div>
                        </div>

                        <!-- Tombol Kirim -->
                        <div class="text-right mt-5">
                            <button type="submit" class="btn px-5 py-2" style="background-color: #0B20E9; color: white; border-radius: 7px;">
                                Buat Task
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Efek Hover dan Fokus -->
    <style>
         .header {
        background-color: #0B20E9;
        color: white;
        font-size: 16px;
        font-weight: 500;
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
    </style>
@endsection
