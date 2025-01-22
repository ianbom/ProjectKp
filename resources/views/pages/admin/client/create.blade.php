@extends('layouts.admin1')

@section('title')
    Add Client
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
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

            <div class="card shadow-sm border-0 mb-5"
                style="border-radius: 7px; background-color: #E8F0FE; transition: transform 0.3s, box-shadow 0.3s;">
                <div class="header" style="background-color: #0B20E9; color: white; border-radius: 8px 8px 0 0;">
                    <p class="card-title text-left" style="padding-left:50px;">Tambah Klient</p>
                </div>

                <div class="card-body p-5">
                    <div class="mb-4"
                        style="color: #4A4A4A; font-size: 14px; line-height: 1.6; border-left: 4px solid #0B20E9; padding-left: 15px;
                                background-color: #FFFFFF; border-radius: 7px; box-shadow: 0 4px 7px rgba(0, 0, 0, 0.02);">
                        <p>
                            Tambahkan informasi klien dengan lengkap dan akurat. Data yang disimpan akan membantu proses pengelolaan klien secara efisien.
                        </p>
                    </div>

                    <form action="{{ route('client.store') }}" method="POST" enctype="multipart/form-data"
                        style="border: 1px solid #0B20E9; border-radius: 7px; padding: 20px; background-color: #ffffff;">
                        @csrf

                        <!-- Informasi Klien -->
                        <div class="form-section mb-5">
                            <h6 class="mb-3" style="color: #0B20E9; font-weight: bold;">Informasi Klien</h6>
                            <div class="form-group mb-4">
                                <label for="name" style="font-weight: 600;">Nama Klien</label>
                                <input type="text" name="name" id="name"
                                    class="form-control shadow-sm"
                                    style="border: 1px solid #0B20E9; border-radius: 7px; padding: 10px; background-color: #f5f8fd;"
                                    placeholder="Masukkan nama klien" required>
                            </div>
                            <div class="form-group mb-4">
                                <label for="slug" style="font-weight: 600;">Slug</label>
                                <input type="text" name="slug" id="slug"
                                    class="form-control shadow-sm"
                                    style="border: 1px solid #0B20E9; border-radius: 7px; padding: 10px; background-color: #f5f8fd;"
                                    placeholder="Masukkan slug(Kode Unik)" required>
                            </div>
                            <div class="form-group mb-4">
                                <label for="phone" style="font-weight: 600;">Nomor</label>
                                <input type="text" name="phone" id="phone"
                                    class="form-control shadow-sm"
                                    style="border: 1px solid #0B20E9; border-radius: 7px; padding: 10px; background-color: #f5f8fd;"
                                    placeholder="Masukkan nomor whatsapp" maxlength="12" pattern="\d*" required>
                            </div>

                        </div>

                        <!-- Detail Keamanan -->

                        <div class="form-section mb-5">
                            <h6 class="mb-3" style="color: #0B20E9; font-weight: bold;">Detail Keamanan</h6>
                            <div class="form-group ">
                                <label for="password" style="font-weight: 600;">Kata Sandi</label>
                                <div style="position: relative;">
                                    <input type="password" name="password" id="password" autocomplete="new-password"
                                        class="form-control shadow-sm"
                                        style="border: 1px solid #0B20E9; border-radius: 7px; padding: 10px; padding-right: 35px; background-color: #f5f8fd;"
                                        placeholder="Minimal 8 karakter, kombinasi huruf & angka" required
                                        >
                                    <!-- Ikon mata -->
                                    <span class="toggle-password" onclick="togglePasswordVisibility()"
                                        style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                                        <i id="eyeIcon" class="fa fa-eye-slash" style="color: #0B20E9;"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Gambar Profil -->
                        <div class="form-section mb-5">
                            <h6 class="mb-3" style="color: #0B20E9; font-weight: bold;">Gambar Profil</h6>
                            <div class="form-group mb-4">
                                <label for="photo" style="font-weight: 600;">Foto Profil Klien</label>
                                <input type="file" name="photo" id="photo"
                                    class="form-control shadow-sm"
                                    style="border: 1px solid #0B20E9; border-radius: 7px; padding: 10px; background-color: #f5f8fd;"
                                    accept=".jpg, .jpeg, .png"
                                    onchange="validateFile()" required>
                                <small class="form-text text-muted" style="margin-top: 5px;">Format yang didukung: JPG, PNG. Pastikan ukuran gambar tidak lebih dari 2MB</small>
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
    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            }
        }

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
    document.getElementById('phone').addEventListener('input', function (e) {
    const value = e.target.value;
    if (value.length > 12) {
        e.target.value = value.slice(0, 12); 
    }
});

</script>

@endsection
