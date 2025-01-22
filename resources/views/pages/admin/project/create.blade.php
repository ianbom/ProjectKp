@extends('layouts.admin1')

@section('title')
    Project {{ $client->name }}
@endsection

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm border-0 mb-5" style="border-radius: 7px; background-color: #E8F0FE; transition: transform 0.3s, box-shadow 0.3s;">
        <div class="header" style="background-color: #0B20E9; color: white; border-radius: 8px 8px 0 0;">
            <h6 class="card-title text-left" style="padding-left:50px;">Tambah Project untuk Client: {{ $client->name }}</h6>
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

            <form action="{{ route('client.project.store', $client->id) }}" method="post" enctype="multipart/form-data" style="border: 1px solid #0B20E9; border-radius: 7px; padding: 20px; background-color: #ffffff;">
                {{ method_field('post') }}
                @csrf

                <!-- Nama Project -->
                <div class="form-section mb-5">
                    <h6 class="mb-3" style="color: #0B20E9; font-weight: bold;">Nama Project</h6>
                    <input type="text" name="name" class="form-control shadow-sm" placeholder="Masukkan judul proyek pesanan"  required style="border: 1px solid #0B20E9; border-radius: 7px; padding: 10px; background-color: #f5f8fd;">
                </div>

                <!-- Jenis Project -->
                <div class="form-section mb-5">
                    <h6 class="mb-3" style="color: #0B20E9; font-weight: bold;">Jenis Project</h6>
                    <select class="form-control shadow-sm" name="jenis" required style="border: 1px solid #0B20E9; border-radius: 7px;">
                        <option value="Website Informasi (BASIC)">Website Informasi (BASIC)</option>
                        <option value="Website Informasi (PRO)">Website Informasi (PRO)</option>
                        <option value="Website Bisnis (BASIC)">Website Bisnis (BASIC)</option>
                        <option value="Website Bisnis (PRO)">Website Bisnis (PRO)</option>
                        <option value="Landing Page">Landing Page</option>
                        <option value="" disabled selected>Pilih Project</option>
                    </select>
                </div>

                <!-- Keterangan -->
                <div class="form-section mb-5">
                    <h6 class="mb-3" style="color: #0B20E9; font-weight: bold;"  >Keterangan</h6>
                    <textarea type="text" rows="5" name="keterangan" class="form-control shadow-sm" required style="border: 1px solid #0B20E9; border-radius: 7px;" placeholder="Masukkan detail deksripsi proyek serta kebutuhan proyek"></textarea>
                </div>

                <!-- Deadline -->
                <div class="form-section mb-5">
                    <h6 class="mb-3" style="color: #0B20E9; font-weight: bold;">Deadline</h6>
                    <input type="datetime-local" id="deadline" name="deadline" class="form-control shadow-sm" required style="border: 1px solid #0B20E9; border-radius: 7px; padding: 10px; background-color: #f5f8fd;">
                </div>

                <!-- Status -->
                <div class="form-section mb-5">
                    <h6 class="mb-3" style="color: #0B20E9; font-weight: bold;">Status</h6>
                    <select class="form-control shadow-sm" name="status" required style="border: 1px solid #0B20E9; border-radius: 7px;">
                        <option value="" disabled selected>PILIH STATUS</option>
                        <option value="On Going">On Going</option>
                        <option value="Revision">Revision</option>
                        <option value="Completed">Completed</option>
                    </select>
                </div>

                <!-- Masa Aktif -->
                <div class="form-section mb-5">
                    <h6 class="mb-3" style="color: #0B20E9; font-weight: bold;">Masa Aktif</h6>
                    <input type="datetime-local" id="masaaktif" name="masaaktif" class="form-control shadow-sm" required style="border: 1px solid #0B20E9; border-radius: 7px; padding: 10px; background-color: #f5f8fd;">
                </div>

                <!-- Notes -->
                <div class="form-section mb-5">
                    <h6 class="mb-3" style="color: #0B20E9; font-weight: bold;">Notes</h6>
                    <input type="text" id="notes" name="notes" class="form-control shadow-sm" required style="border: 1px solid #0B20E9; border-radius: 7px; padding: 10px; background-color: #f5f8fd;" placeholder="Bisa memasukkan link asset/keterangan tambahan (pilih salah satu saja)">
                    <div id="link-preview" class="mt-2" style="display: none;">
                        <a id="link-preview-anchor" href="#" target="_blank" style="color: #0B20E9; font-style: italic; font-size: 0.875rem;">Klik di sini untuk membuka tautan</a>
                    </div>
                </div>

                <!-- Img Project -->
                <div class="form-section mb-5">
                    <h6 class="mb-3" style="color: #0B20E9; font-weight: bold;">Img Project</h6>
                    <div class="form-group mb-4">
                        <input type="file" name="photo" id="photo"
                            class="form-control shadow-sm"
                            style="border: 1px solid #0B20E9; border-radius: 7px; padding: 10px; background-color: #f5f8fd;"
                            accept=".jpg, .jpeg, .png"
                            onchange="validateFile()" required>
                        <small class="form-text text-muted" style="margin-top: 5px;">Format yang didukung: JPG, PNG. Pastikan ukuran gambar tidak lebih dari 2MB</small>
                    </div>
                </div>

                <!-- Tombol -->
                <div class="text-right mt-5">
                    <button type="submit" class="btn px-5 py-2" style="background-color: #0B20E9; color: white; border-radius: 7px;">
                        Simpan Project
                    </button>
                    <a href="{{ route('client.project.index', $client->id) }}" class="btn px-5 py-2 btn-secondary" style="border-radius: 7px;">
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
<script>
    // Mendapatkan elemen input
    const deadlineInput = document.getElementById('deadline');
    const masaAktifInput = document.getElementById('masaaktif');

    // Mengatur nilai minimum (min) berdasarkan tanggal dan waktu saat ini
    const now = new Date();
    const year = now.getFullYear();
    const month = String(now.getMonth() + 1).padStart(2, '0');
    const day = String(now.getDate()).padStart(2, '0');
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');

    // Format menjadi string yang sesuai untuk datetime-local
    const minDateTime = `${year}-${month}-${day}T${hours}:${minutes}`;

    // Atur nilai minimum (min) pada kedua input
    deadlineInput.min = minDateTime;
    masaAktifInput.min = minDateTime;


    const notesInput = document.getElementById('notes');
    const linkPreview = document.getElementById('link-preview');
    const linkAnchor = document.getElementById('link-preview-anchor');

    // Event listener untuk mendeteksi perubahan input
    notesInput.addEventListener('input', function () {
        const inputValue = notesInput.value.trim();

        // Validasi apakah input adalah URL
        const urlPattern = /^(https?:\/\/[^\s$.?#].[^\s]*)$/i;
        if (urlPattern.test(inputValue)) {
            linkAnchor.href = inputValue; // Set href ke URL
            linkPreview.style.display = 'block'; // Tampilkan link preview
        } else {
            linkPreview.style.display = 'none'; // Sembunyikan jika bukan URL
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
