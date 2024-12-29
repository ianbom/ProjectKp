@extends('layouts.admin1')

@section('title')
    Edit Project {{ $item->name }}
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
                <h6 class="card-title text-left" style="padding-left:50px;">Edit Project</h6>
            </div>
            <div class="card-body p-5">
                <!-- Judul -->


                <!-- Penjelasan -->
                <div class="mb-4 mt-4  "
                style="color: #4A4A4A; font-size: 14px; line-height: 1.6; border-left: 4px solid #0B20E9; padding-left: 15px; padding-top:1px;  padding-bottom:1px;
                        background-color: #FFFFFF; border-radius: 7px; box-shadow: 0 4px 7px rgba(0, 0, 0, 0.02);">
                <p style="margin-top: 20px;" >
                    Edit informasi project dengan hati-hati. Pastikan data yang diubah akurat dan sesuai kebutuhan.
                </p>
            </div>


                <!-- Formulir -->
                <form action="{{ route('project.update', $item->id) }}" method="POST" enctype="multipart/form-data"
                    style="border: 1px solid #0B20E9; border-radius: 7px; padding: 20px; background-color: #ffffff;">
                    @method('PUT')
                    @csrf

                    <!-- Informasi Project -->
                    <div class="form-section mb-5">
                        <h6 class="mb-3" style="color: #0B20E9; font-weight: bold;">Informasi Project</h6>
                        <div class="form-group mb-4">
                            <label for="name" style="font-weight: 600;">Nama Project</label>
                            <input type="text" name="name" id="name" class="form-control shadow-sm"
                                style="border: 1px solid #0B20E9; border-radius: 7px; transition: box-shadow 0.3s;"
                                value="{{ $item->name }}" required>
                        </div>
                        <div class="form-group mb-4">
                            <label for="jenis" style="font-weight: 600;">Jenis Project</label>
                            <select class="form-control shadow-sm" name="jenis" id="jenis"
                                style="border: 1px solid #0B20E9; border-radius: 7px; transition: box-shadow 0.3s;"
                                required>
                                <option value="Website Informasi (BASIC)">Website Informasi (BASIC)</option>
                                <option value="Website Informasi (PRO)">Website Informasi (PRO)</option>
                                <option value="Website Bisnis (BASIC)">Website Bisnis (BASIC)</option>
                                <option value="Website Bisnis (PRO)">Website Bisnis (PRO)</option>
                                <option value="Landing Page">Landing Page</option>
                                <option value="{{ $item->jenis }}" selected>{{ $item->jenis }}</option>
                            </select>
                        </div>
                        <div class="form-group mb-4">
                            <label for="keterangan" style="font-weight: 600;">Keterangan</label>
                            <textarea type="text" name="keterangan" id="keterangan"
                                class="form-control shadow-sm"
                                style="border: 1px solid #0B20E9; border-radius: 7px; transition: box-shadow 0.3s;"
                                required>{{ $item->keterangan }}</textarea>
                        </div>
                        <div class="form-group mb-4">
                            <label for="deadline" style="font-weight: 600;">Deadline</label>
                            <input type="datetime-local" name="deadline" id="deadline"
                                class="form-control shadow-sm"
                                style="border: 1px solid #0B20E9; border-radius: 7px; transition: box-shadow 0.3s;"
                                value="{{ $item->deadline }}" required>
                        </div>
                        <div class="form-group mb-4">
                            <label for="status" style="font-weight: 600;">Status</label>
                            <select class="form-control shadow-sm" name="status" id="status"
                                style="border: 1px solid #0B20E9; border-radius: 7px; transition: box-shadow 0.3s;"
                                required>
                                <option value="On Going">On Going</option>
                                <option value="Revision">Revision</option>
                                <option value="Completed">Completed</option>
                                <option value="{{ $item->status }}" selected>{{ $item->status }}</option>
                            </select>
                        </div>
                    </div>

                    <!-- Gambar Project -->
                    <div class="form-section mb-5">
                        <h6 class="mb-3" style="color: #0B20E9; font-weight: bold;">Gambar Project</h6>
                        <div class="form-group mb-4">
                            <label for="photo" style="font-weight: 600;">Foto Project</label>
                            <input type="file" name="photo" id="photo" class="form-control shadow-sm"
                                style="border: 1px solid #0B20E9; border-radius: 7px; transition: box-shadow 0.3s;">
                            <img src="{{ Storage::url($item->photo) }}" height="250px" width="200"
                                style="object-fit: contain; margin-top: 15px;">
                        </div>
                    </div>

                    <!-- Tombol Simpan -->
                    <div class="text-right mt-5">
                        <button type="submit" class="btn px-5 py-2"
                            style="background-color: #0B20E9; color: white; border-radius: 7px;">
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
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        border-color: #0B20E9;
    }

    .btn {
        background-color: #0B20E9;
        color: #FFFFFF;
        font-weight: 500;
        border: none;
        border-radius: 7px;
        padding: 10px 20px;
        box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.15);
        transition: background-color 0.3s, color 0.3s, box-shadow 0.3s;
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
