@extends('layouts.karyawan')

@section('title', 'Detail Progress Karyawan')

@section('content')
<style>
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

    .card {
        border-radius: 10px;
        background-color: #E8F0FE;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }
    .card1 {
        border-radius: 10px;
        background-color: #FFFFFF;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background-color: #0B20E9;
        color: white;
        border-radius: 10px 10px 0 0;
        font-weight: bold;
        padding-bottom: 10px;
        padding-top: 20px;
    }

    .card-body {
        background-color: #FFFFFF;
        border-radius: 10px 10px 10px 10px;

    }
    .card1-body {
        background-color: #E8F0FE;
        border-radius: 0 0 10px 10px;
    }

    table {
        background-color: #FFFFFF;
        border-radius: 7px;
    }

    th {
        background-color: #0B20E9;
        color: #E8F0FE;
    }

    img {
        border-radius: 7px;
        max-height: 200px;
        object-fit: cover;
    }
</style>

<div class="container mt-5">
    <div  >
        <div class="card-header">
            <h6>Detail Progress Karyawan</h6>
        </div>
        <div class="card1-body p-5">

            <!-- Informasi Progress -->
            <h5 class="mb-4" style="color: #0B20E9; font-weight: bold;">Informasi Progress</h5>
            <div class="row">
                <!-- Deskripsi Card -->
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm border-0" style="border-radius: 10px; background-color: #ffffff;">
                        <div class="card-body">
                            <h6 style="color: #0B20E9; font-weight: bold;">Deskripsi</h6>
                            <p>{{ $progress->deskripsi }}</p>
                        </div>
                    </div>
                </div>

                <!-- Status Card -->
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm border-0" style="border-radius: 10px; background-color: #FFFFFF;">
                        <div class="card-body">
                            <h6 style="color: #0B20E9; font-weight: bold;">Status</h6>
                            <p>{{ $progress->status }}</p>
                        </div>
                    </div>
                </div>

                <!-- Comment Card -->
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm border-0" style="border-radius: 10px; background-color: #FFFFFF;">
                        <div class="card-body">
                            <h6 style="color: #0B20E9; font-weight: bold;">Comment</h6>
                            <p>{{ $progress->comment ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Created At Card -->
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm border-0" style="border-radius: 10px; background-color: #FFFFFF;">
                        <div class="card-body">
                            <h6 style="color: #0B20E9; font-weight: bold;">Created At</h6>
                            <p>{{ \Carbon\Carbon::parse($progress->created_at)->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Progress Images -->
            <h5 class="mt-5 mb-4" style="color: #0B20E9; font-weight: bold;">Progress Images</h5>
            <div class="row">
                @forelse($progress->imageProgress as $image)
                    @php
                        $fileUrl = Storage::url($image->image);
                        $fileExtension = pathinfo($fileUrl, PATHINFO_EXTENSION);
                    @endphp

                    @if(strtolower($fileExtension) === 'pdf')
                        <div class="col-md-3 mb-4">
                            <div class="card shadow-sm border-0 text-center">
                                <div class="card-body">
                                    <p class="text-muted">{{ basename($fileUrl) }}</p>
                                    <a href="{{ $fileUrl }}" class="btn btn-outline-primary btn-sm" target="_blank">
                                        <i class="fas fa-file-pdf"></i> Download PDF
                                    </a>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-md-3 mb-4">
                            <div class="card shadow-sm border-0">
                                <div class="card-body p-0">
                                    <img src="{{ $fileUrl }}" alt="Progress Image" class="img-fluid rounded">
                                </div>
                            </div>
                        </div>
                    @endif
                @empty
                    <p class="text-center col-12">Tidak ada gambar untuk progress ini.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

