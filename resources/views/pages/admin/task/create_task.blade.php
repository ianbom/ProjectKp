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
                <div class="card-body p-5">
                    <!-- Judul -->
                    <h2 class="font-weight-bold mb-4 text-center" style="color: #0B20E9;">Buat Task Baru</h2>

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
                            <h5 class="mb-3" style="color: #0B20E9; font-weight: bold;">Pilih Project (Opsional)</h5>
                            <div class="form-group mb-4">
                                <label for="id_projects" style="font-weight: 600;">Project</label>
                                <select name="id_projects" id="id_projects" class="form-control shadow-sm"
                                    style="border: 1px solid #0B20E9; border-radius: 7px; transition: box-shadow 0.3s;">
                                    <option value="">Tidak Ada</option>
                                    @foreach($projects as $project)
                                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Pilih Pengguna (Required) -->
                        <div class="form-section mb-5">
                            <h5 class="mb-3" style="color: #0B20E9; font-weight: bold;">Penugasan Pengguna</h5>
                            <div class="form-group mb-4">
                                <label for="id" style="font-weight: 600;">Pilih Pengguna</label>
                                <select name="id" id="id" class="form-control shadow-sm"
                                    style="border: 1px solid #0B20E9; border-radius: 7px; transition: box-shadow 0.3s;" required>
                                    <option value="">Pilih Pengguna</option>
                                    @foreach($user as $u)
                                        <option value="{{ $u->id }}">{{ $u->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Judul Tugas (Required) -->
                        <div class="form-section mb-5">
                            <h5 class="mb-3" style="color: #0B20E9; font-weight: bold;">Judul Task</h5>
                            <div class="form-group mb-4">
                                <label for="title" style="font-weight: 600;">Judul Task</label>
                                <input type="text" name="title" id="title" class="form-control shadow-sm"
                                    style="border: 1px solid #0B20E9; border-radius: 7px; transition: box-shadow 0.3s;"
                                    placeholder="Masukkan judul tugas" required>
                            </div>
                        </div>

                        <!-- Deskripsi Tugas (Required) -->
                        <div class="form-section mb-5">
                            <h5 class="mb-3" style="color: #0B20E9; font-weight: bold;">Deskripsi Task</h5>
                            <div class="form-group mb-4">
                                <label for="description" style="font-weight: 600;">Deskripsi Task</label>
                                <textarea name="description" id="description" class="form-control shadow-sm"
                                    style="border: 1px solid #0B20E9; border-radius: 7px; transition: box-shadow 0.3s;"
                                    rows="5" placeholder="Masukkan deskripsi tugas" required></textarea>
                            </div>
                        </div>

                        <!-- Upload Gambar (Optional) -->
                        <div class="form-section mb-5">
                            <h5 class="mb-3" style="color: #0B20E9; font-weight: bold;">Unggah Gambar</h5>
                            <div class="form-group mb-4">
                                <label for="image" style="font-weight: 600;">Upload Gambar</label>
                                <input type="file" name="image[]" id="image" class="form-control shadow-sm"
                                    style="border: 1px solid #0B20E9; border-radius: 7px; transition: box-shadow 0.3s;" multiple
                                    accept="image/jpeg,image/png,application/pdf">
                            </div>
                        </div>

                        <!-- Tombol Kirim -->
                        <div class="text-right mt-5">
                            <button type="submit"
                                    class="btn px-5 py-2">
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
