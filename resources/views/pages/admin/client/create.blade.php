@extends('layouts.admin1')

@section('title')
    Add Client
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
                    <h2 class="font-weight-bold mb-4 text-center" style="color: #0B20E9;">Tambah Klien Baru</h2>

                    <!-- Penjelasan -->
                    <div class="mb-4"
                        style="color: #4A4A4A; font-size: 14px; line-height: 1.6; border-left: 4px solid #0B20E9; padding-left: 15px;
                                background-color: #FFFFFF; border-radius: 7px; box-shadow: 0 4px 7px rgba(0, 0, 0, 0.02);">
                        <p>
                            Tambahkan informasi klien dengan lengkap dan akurat. Data yang disimpan akan membantu proses pengelolaan klien secara efisien.
                        </p>
                    </div>

                    <!-- Formulir -->
                    <form action="{{ route('client.store') }}" method="POST" enctype="multipart/form-data"
                        style="border: 1px solid #0B20E9; border-radius: 7px; padding: 20px; background-color: #ffffff;">
                        @csrf

                        <!-- Informasi Klien -->
                        <div class="form-section mb-5">
                            <h5 class="mb-3" style="color: #0B20E9; font-weight: bold;">Informasi Klien</h5>
                            <div class="form-group mb-4">
                                <label for="name" style="font-weight: 600;">Nama Klien</label>
                                <input type="text" name="name" id="name"
                                    class="form-control shadow-sm"
                                    style="border: 1px solid #0B20E9; border-radius: 7px; transition: box-shadow 0.3s;"
                                    placeholder="Masukkan nama klien" required>
                            </div>
                            <div class="form-group mb-4">
                                <label for="slug" style="font-weight: 600;">Slug</label>
                                <input type="text" name="slug" id="slug"
                                    class="form-control shadow-sm"
                                    style="border: 1px solid #0B20E9; border-radius: 7px; transition: box-shadow 0.3s;"
                                    placeholder="Masukkan slug" required>
                            </div>
                        </div>

                        <!-- Detail Keamanan -->
                        <div class="form-section mb-5">
                            <h5 class="mb-3" style="color: #0B20E9; font-weight: bold;">Detail Keamanan</h5>
                            <div class="form-group mb-4">
                                <label for="password" style="font-weight: 600;">Kata Sandi</label>
                                <input type="text" name="password" id="password"
                                    class="form-control shadow-sm"
                                    style="border: 1px solid #0B20E9; border-radius: 7px; transition: box-shadow 0.3s;"
                                    placeholder="Masukkan kata sandi" required>
                            </div>
                        </div>

                        <!-- Gambar Profil -->
                        <div class="form-section mb-5">
                            <h5 class="mb-3" style="color: #0B20E9; font-weight: bold;">Gambar Profil</h5>
                            <div class="form-group mb-4">
                                <label for="photo" style="font-weight: 600;">Foto Profil Klien</label>
                                <input type="file" name="photo" id="photo"
                                    class="form-control shadow-sm"
                                    style="border: 1px solid #0B20E9; border-radius: 7px; transition: box-shadow 0.3s;"
                                    required>
                            </div>
                        </div>

                        <!-- Tombol Simpan -->
                        <div class="text-right mt-5">
                            <button type="submit"
                                    class="btn px-5 py-2">
                                Simpan
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

        div.mb-4 p {
            margin: 0;
            transition: all 0.3s ease;
        }
    </style>
@endsection


