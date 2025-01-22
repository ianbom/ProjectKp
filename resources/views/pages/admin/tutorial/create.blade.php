@extends('layouts.admin1')

@section('title')
    Add Video Tutorial
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
                    <p class="card-title text-left" style="padding-left:50px;">Tambah Video Tutorial</p>
                </div>

                <div class="card-body p-5">
                    <!-- Penjelasan -->
                    <div class="mb-4"
                        style="color: #4A4A4A; font-size: 14px; line-height: 1.6; border-left: 4px solid #0B20E9; padding-left: 15px;
                                background-color: #FFFFFF; border-radius: 7px; box-shadow: 0 4px 7px rgba(0, 0, 0, 0.02);">
                        <p>
                            Tambahkan video tutorial yang bermanfaat untuk pengguna. Pastikan link video YouTube yang diberikan benar dan dapat diakses dengan mudah.
                        </p>
                    </div>

                    <!-- Formulir -->
                    <form action="{{ route('tutorial.store') }}" method="POST" enctype="multipart/form-data"
                        style="border: 1px solid #0B20E9; border-radius: 7px; padding: 20px; background-color: #ffffff;">
                        @csrf

                        <!-- Informasi Tutorial -->
                        <div class="form-section mb-5">
                            <h5 class="mb-3" style="color: #0B20E9; font-weight: bold;">Informasi Tutorial</h5>
                            <div class="form-group mb-4">
                                <label for="author" style="font-weight: 600;">Nama Author</label>
                                <input type="text" name="author" id="author" value="{{ Auth::user()->name }}"
                                    class="form-control shadow-sm"
                                    style="border: 1px solid #0B20E9; border-radius: 7px; padding: 10px; background-color: #f5f8fd;"
                                    required>
                                    <small class="form-text text-muted" style="margin-top: 5px;">Author bisa diganti sesuai kebutuhan </small>

                            </div>
                            <div class="form-group mb-4">
                                <label for="link" style="font-weight: 600;">Tautan YouTube</label>
                                <input type="text" name="link" id="link"
                                    class="form-control shadow-sm"
                                    style="border: 1px solid #0B20E9; border-radius: 7px; padding: 10px; background-color: #f5f8fd;"
                                    placeholder="Link harus berformat: https://www.youtube.com/watch?v=QOHOp_Aph68" required>

                            </div>
                        </div>

                        <!-- Tombol Simpan -->
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

        h5 {
            font-size: 18px;
            font-weight: bold;
        }
    </style>
@endsection
