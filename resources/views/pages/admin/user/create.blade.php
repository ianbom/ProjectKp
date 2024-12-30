@extends('layouts.admin1')

@section('title')
    Add User
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
                    <p class="card-title text-left" style="padding-left:50px;">Tambah Pengguna Baru</p>
                </div>


                <div class="card-body p-5">
                    <!-- Description -->
                    <div class="mb-4"
                        style="color: #4A4A4A; font-size: 14px; line-height: 1.6; border-left: 4px solid #0B20E9; padding-left: 15px;
                                background-color: #FFFFFF; border-radius: 7px; box-shadow: 0 4px 7px rgba(0, 0, 0, 0.02);">
                        <p>
                            Tambahkan informasi pengguna dengan lengkap dan akurat. Data yang disimpan akan membantu dalam pengelolaan akses dan hak pengguna.
                        </p>
                    </div>

                    <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data"
                        style="border: 1px solid #0B20E9; border-radius: 7px; padding: 20px; background-color: #ffffff;">
                        @csrf

                        <!-- Informasi Pengguna -->
                        <div class="form-section mb-5">
                            <h5 class="mb-3" style="color: #0B20E9; font-weight: bold;">Informasi Pengguna</h5>
                            <div class="form-group mb-4">
                                <label for="name" style="font-weight: 600;">Nama Pengguna</label>
                                <input type="text" name="name" id="name"
                                    class="form-control shadow-sm"
                                    style="border: 1px solid #0B20E9; border-radius: 7px; padding: 10px; background-color: #f5f8fd;"
                                    placeholder="Masukkan nama user" required>
                            </div>
                            <div class="form-group mb-4">
                                <label for="email" style="font-weight: 600;">Email</label>
                                <input type="email" name="email" id="email"
                                    class="form-control shadow-sm"
                                    style="border: 1px solid #0B20E9; border-radius: 7px; padding: 10px; background-color: #f5f8fd;"
                                    placeholder="Masukkan email" required>
                            </div>
                            <div class="form-group mb-4">
                                <label for="password" style="font-weight: 600;">Kata Sandi</label>
                                <input type="text" name="password" id="password"
                                    class="form-control shadow-sm"
                                    style="border: 1px solid #0B20E9; border-radius: 7px; transition: box-shadow 0.3s;"
                                    placeholder="Masukkan kata sandi" required>
                            </div>
                        </div>

                        <!-- Roles Section -->
                        <div class="form-section mb-5">
                            <h6 class="mb-3" style="color: #0B20E9; font-weight: bold;">Roles Pengguna</h6>
                            <div class="form-group mb-4">
                                <label for="roles" style="font-weight: 600;">Roles</label>
                                <select name="roles" id="roles" class="form-control shadow-sm"
                                    style="border: 1px solid #080e44; border-radius: 7px; padding: 10px; background-color: #f5f8fd;" required>
                                    <option value="" disabled selected>Pilih Roles</option>
                                    <option value="ADMIN">ADMIN</option>
                                    <option value="KARYAWAN">KARYAWAN</option>
                                </select>
                            </div>
                        </div>

                        <!-- Profile Image Section -->
                        <div class="form-section mb-5">
                            <h6 class="mb-3" style="color: #0B20E9; font-weight: bold;">Foto Profil Pengguna</h6>
                            <div class="form-group mb-4">
                                <label for="photo" style="font-weight: 600;">Upload Foto Profil</label>
                                <input type="file" name="photo" id="photo"
                                    class="form-control shadow-sm"
                                    style="border: 1px solid #0B20E9; border-radius: 7px; padding: 10px; background-color: #f5f8fd;" required>
                            </div>
                        </div>

                        <!-- Save Button -->
                        <div class="text-right mt-5">
                            <button type="submit" class="btn px-5 py-2" style="background-color: #0B20E9; color: white; border-radius: 7px;">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
