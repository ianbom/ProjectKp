@extends('layouts.admin1')

@section('title')
    Edit Client {{ $item->name }}
@endsection

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm border-0 mb-5"
        style="border-radius: 7px; background-color: #E8F0FE; transition: transform 0.3s, box-shadow 0.3s;">
        <div class="header" style="background-color: #0B20E9; color: white; border-radius: 8px 8px 0 0;">
            <h6 class="card-title text-left" style="padding-left:50px;">Edit Klien</h6>
        </div>

        <div class="card-body p-5">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('client.update', $item->id) }}" method="POST" enctype="multipart/form-data"
                style="border: 1px solid #0B20E9; border-radius: 7px; padding: 20px; background-color: #ffffff;">
                @method('PUT')
                @csrf

                <!-- Informasi Klien -->
                <div class="form-section mb-5">
                    <h6 class="mb-3" style="color: #0B20E9; font-weight: bold;">Informasi Klien</h6>
                    <div class="form-group mb-4">
                        <label for="name" style="font-weight: 600;">Nama Klien</label>
                        <input type="text" name="name" id="name" class="form-control shadow-sm"
                            style="border: 1px solid #0B20E9; border-radius: 7px; transition: box-shadow 0.3s;"
                            value="{{ $item->name }}" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="slug" style="font-weight: 600;">Slug</label>
                        <input type="text" name="slug" id="slug" class="form-control shadow-sm"
                            style="border: 1px solid #0B20E9; border-radius: 7px; transition: box-shadow 0.3s;"
                            value="{{ $item->slug }}" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="phone" style="font-weight: 600;">Nomor</label>
                        <input type="number" name="phone" id="phone" class="form-control shadow-sm"
                            style="border: 1px solid #0B20E9; border-radius: 7px; transition: box-shadow 0.3s;"
                            value="{{ $item->phone }}" required>
                    </div>
                </div>

                <!-- Detail Keamanan -->
                <div class="form-section mb-5">
                    <h6 class="mb-3" style="color: #0B20E9; font-weight: bold;">Detail Keamanan</h6>
                    <div class="form-group mb-4">
                        <label for="password" style="font-weight: 600;">Kata Sandi</label>
                        <input type="text" name="password" id="password" class="form-control shadow-sm"
                            style="border: 1px solid #0B20E9; border-radius: 7px; transition: box-shadow 0.3s;"
                            value="{{ $item->password }}" required>
                    </div>
                </div>

                <!-- Gambar Profil -->
                <div class="form-section mb-5">
                    <h6 class="mb-3" style="color: #0B20E9; font-weight: bold;">Gambar Profil</h6>
                    <div class="form-group mb-4">
                        <label for="photo" style="font-weight: 600;">Foto Profil Klien</label>
                        <input type="file" name="photo" id="photo" class="form-control shadow-sm"
                            style="border: 1px solid #0B20E9; border-radius: 7px; transition: box-shadow 0.3s;">
                        <img src="{{ Storage::url($item->photo) }}" height="250px" width="200"
                            style="object-fit: contain; margin-top: 15px;">
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
