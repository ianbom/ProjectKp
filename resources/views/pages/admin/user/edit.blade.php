@extends('layouts.admin1')

@section('title')
    Edit User {{ $item->name }}
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

        <div class="card shadow-sm border-0 mb-5" style="border-radius: 7px; background-color: #E8F0FE; transition: transform 0.3s, box-shadow 0.3s;">
            <div class="header" style="background-color: #0B20E9; color: white; border-radius: 8px 8px 0 0;">
                <h6 class="card-title text-left" style="padding-left:50px;">Edit Pengguna</h6>
            </div>
            <div class="card-body p-5">

                <!-- Penjelasan -->
                <div class="mb-4" style="color: #4A4A4A; font-size: 14px; line-height: 3; border-left: 4px solid #0B20E9; padding-left: 15px; background-color: #FFFFFF; border-radius: 7px; box-shadow: 0 4px 7px rgba(0, 0, 0, 0.02);">
                    <p>Edit informasi pengguna dengan hati-hati. Pastikan data yang diubah akurat dan sesuai kebutuhan.</p>
                </div>

                <!-- Formulir -->
                <form action="{{ route('user.update', $item->id) }}" method="POST" enctype="multipart/form-data" style="border: 1px solid #0B20E9; border-radius: 7px; padding: 20px; background-color: #ffffff;">
                    @method('PUT')
                    @csrf

                    <!-- Informasi User -->
                    <div class="form-section mb-5">
                        <h5 class="mb-3" style="color: #0B20E9; font-weight: bold;">Informasi Pengguna</h5>
                        <div class="form-group mb-4">
                            <label for="name" style="font-weight: 600;">Nama Pengguna</label>
                            <input type="text" name="name" id="name" class="form-control shadow-sm" style="border: 1px solid #0B20E9; border-radius: 7px; transition: box-shadow 0.3s;" value="{{ $item->name }}" required>
                        </div>

                        <div class="form-group mb-4">
                            <label for="email" style="font-weight: 600;">Email</label>
                            <input type="email" name="email" id="email"
                                class="form-control shadow-sm"
                                style="border: 1px solid #0B20E9; border-radius: 7px; padding: 10px; background-color: #f5f8fd;"
                                pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}" value="{{ $item->email }}" required>
                        </div>
                        <div class="form-group mb-4">
                            <label for="phone" style="font-weight: 600;">Nomor</label>
                            <input type="text" name="phone" id="phone"
                                class="form-control shadow-sm"
                                style="border: 1px solid #0B20E9; border-radius: 7px; padding: 10px; background-color: #f5f8fd;"
                                value="{{ $item->phone }}"  maxlength="12" pattern="\d*" required>
                        </div>
                    </div>

                    <!-- Roles -->
                    <div class="form-section mb-5">
                        <h5 class="mb-3" style="color: #0B20E9; font-weight: bold;">Roles Pengguna</h5>
                        <div class="form-group mb-4">
                            <label for="roles" style="font-weight: 600;">Roles</label>
                            <select class="form-control shadow-sm" name="roles" id="roles" style="border: 1px solid #0B20E9; border-radius: 7px; transition: box-shadow 0.3s;" required>
                                <option value="{{ $item->roles }}" selected>{{ $item->roles }}</option>
                                <option value="KARYAWAN">KARYAWAN</option>
                                <option value="ADMIN">ADMIN</option>
                            </select>
                        </div>
                    </div>

                    <!-- Gambar Profil -->
                    <div class="form-section mb-5">
                        <h6 class="mb-3" style="color: #0B20E9; font-weight: bold;">Gambar Profil</h6>
                        <div class="form-group mb-4">
                            <label for="photo" style="font-weight: 600;">Foto Profil Pengguna</label>
                            <input type="file" name="photo" id="photo"
                                class="form-control shadow-sm"
                                style="border: 1px solid #0B20E9; border-radius: 7px; padding: 10px; background-color: #f5f8fd;"
                                accept=".jpg, .jpeg, .png"
                                onchange="validateFile()" >
                            <small class="form-text text-muted" style="margin-top: 5px;">Format yang didukung: JPG, PNG. Pastikan ukuran gambar tidak lebih dari 2MB</small>
                            <img src="{{ Storage::url($item->photo) }}" height="250px" width="200" style="object-fit: contain; margin-top: 15px;">
                        </div>
                    </div>

                    <!-- Tombol Simpan -->
                    <div class="text-right mt-5">
                        <button type="submit" class="btn px-5 py-2" style="background-color: #0B20E9; color: #FFFFFF; font-weight: 500; border-radius: 7px;">
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
    .header {
        background-color: #0B20E9;
        color: white;
        font-weight: bold;
        padding-bottom: 10px;
        padding-top: 20px;
    }
</style>
<script>
    document.getElementById('email').addEventListener('input', function (e) {
    const emailPattern = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/;
    const emailInput = e.target.value;
    if (!emailPattern.test(emailInput)) {
        e.target.setCustomValidity('Masukkan format email yang valid, seperti nama@example.com');
    } else {
        e.target.setCustomValidity('');
    }
});
document.getElementById('phone').addEventListener('input', function (e) {
    const value = e.target.value;
    if (value.length > 12) {
        e.target.value = value.slice(0, 12);
    }
    });
    function validateFile() {
        const fileInput = document.getElementById('photo');
        const file = fileInput.files[0];

        if (file) {
            const allowedExtensions = ['image/jpeg', 'image/png'];
            const maxSize = 2 * 1024 * 1024; // 2MB in bytes

            // Validasi format file
            if (!allowedExtensions.includes(file.type)) {
                alert('Format file tidak didukung. Harap unggah file dalam format JPG atau PNG.');
                fileInput.value = ''; // Reset input file
                return;
            }

            // Validasi ukuran file
            if (file.size > maxSize) {
                alert('Ukuran file terlalu besar. Pastikan ukuran gambar tidak lebih dari 2MB.');
                fileInput.value = ''; // Reset input file
            }
        }
    }
</script>
@endsection
