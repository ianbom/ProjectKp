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
                    <input type="text" name="name" class="form-control shadow-sm" required style="border: 1px solid #0B20E9; border-radius: 7px; padding: 10px; background-color: #f5f8fd;">
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
                    <h6 class="mb-3" style="color: #0B20E9; font-weight: bold;">Keterangan</h6>
                    <textarea type="text" rows="5" name="keterangan" class="form-control shadow-sm" required style="border: 1px solid #0B20E9; border-radius: 7px;"></textarea>
                </div>

                <!-- Deadline -->
                <div class="form-section mb-5">
                    <h6 class="mb-3" style="color: #0B20E9; font-weight: bold;">Deadline</h6>
                    <input type="datetime-local" name="deadline" class="form-control shadow-sm" required style="border: 1px solid #0B20E9; border-radius: 7px; padding: 10px; background-color: #f5f8fd;">
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
                    <input type="datetime-local" name="masaaktif" class="form-control shadow-sm" required style="border: 1px solid #0B20E9; border-radius: 7px; padding: 10px; background-color: #f5f8fd;">
                </div>

                <!-- Notes -->
                <div class="form-section mb-5">
                    <h6 class="mb-3" style="color: #0B20E9; font-weight: bold;">Notes</h6>
                    <input type="text" name="notes" class="form-control shadow-sm" required style="border: 1px solid #0B20E9; border-radius: 7px; padding: 10px; background-color: #f5f8fd;">
                </div>

                <!-- Img Project -->
                <div class="form-section mb-5">
                    <h6 class="mb-3" style="color: #0B20E9; font-weight: bold;">Img Project</h6>
                    <input type="file" name="photo" class="form-control shadow-sm" required style="border: 1px solid #0B20E9; border-radius: 7px; padding: 10px; background-color: #f5f8fd;">
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
@endsection
