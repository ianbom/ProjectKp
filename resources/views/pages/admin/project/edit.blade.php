    @extends('layouts.admin1')

@section('title')
    Edit Project
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
  <!-- Notes -->
  <div class="form-section mb-5">
    <h6 class="mb-3" style="color: #0B20E9; font-weight: bold;">Notes</h6>
    <textarea id="notes" name="notes" class="form-control shadow-sm" required
        style="border: 1px solid #0B20E9; border-radius: 7px; padding: 10px; background-color: #f5f8fd;"
        oninput="updateLinkPreview()">{{ $item->notes }}</textarea>
    <div id="link-preview" class="mt-2" style="display: none;">
        <a id="link-preview-anchor" href="#" target="_blank" style="color: #0B20E9; font-style: italic; font-size: 0.875rem;">
            Klik di sini untuk membuka tautan
        </a>
    </div>
</div>


                        <div class="form-group mb-4">
                            <label for="deadline" style="font-weight: 600;">Deadline</label>
                            <input type="datetime-local" name="deadline" id="deadline"
                                class="form-control shadow-sm"
                                style="border: 1px solid #0B20E9; border-radius: 7px; transition: box-shadow 0.3s;"
                                value="{{ $item->deadline }}" required>
                        </div>

                        <div class="form-group mb-4">
                            <label for="masaaktif" style="font-weight: 600;">Masa Aktif</label>
                            <input type="datetime-local" id="masaaktif" name="masaaktif" class="form-control shadow-sm" value="{{ $item->masaaktif }}"  required style="border: 1px solid #0B20E9; border-radius: 7px; padding: 10px; background-color: #f5f8fd;">
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




                <!-- Img Project -->
                <div class="form-section mb-5">
                    <h6 class="mb-3" style="color: #0B20E9; font-weight: bold;">Gambar Project</h6>
                    <div class="form-group mb-4">
                        <label for="photo" style="font-weight: 600;">Foto Project</label>
                        <input type="file" name="photo" id="photo"
                            class="form-control shadow-sm"
                            style="border: 1px solid #0B20E9; border-radius: 7px; padding: 10px; background-color: #f5f8fd;"
                            accept=".jpg, .jpeg, .png"
                            onchange="validateFile()">
                        <small class="form-text text-muted" style="margin-top: 5px;">Format yang didukung: JPG, PNG. Pastikan ukuran gambar tidak lebih dari 2MB</small>
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


    function updateLinkPreview() {
        const notesInput = document.getElementById('notes');
        const linkPreview = document.getElementById('link-preview');
        const linkAnchor = document.getElementById('link-preview-anchor');

        const inputValue = notesInput.value.trim();

        // Validasi apakah input adalah URL
        const urlPattern = /^(https?:\/\/[^\s$.?#].[^\s]*)$/i;
        if (urlPattern.test(inputValue)) {
            linkAnchor.href = inputValue; // Set href ke URL
            linkAnchor.innerText = "Klik di sini untuk membuka tautan"; // Teks tautan
            linkPreview.style.display = 'block'; // Tampilkan preview
        } else {
            linkPreview.style.display = 'none'; // Sembunyikan jika bukan URL
        }
    }

    // Panggil updateLinkPreview() saat halaman dimuat untuk memeriksa isi awal
    document.addEventListener('DOMContentLoaded', updateLinkPreview);
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
