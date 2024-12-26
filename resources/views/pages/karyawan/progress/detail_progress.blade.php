@extends('layouts.karyawan')

@section('title', 'Detail Progress Karyawan')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Detail Progress Karyawan</h4>
        </div>
        <div class="card-body">
            <h5 class="mt-3 mb-3">Informasi Progress</h5>
            <table class="table table-bordered">
                <tr>
                    <th>Deskripsi</th>
                    <td>{{ $progress->deskripsi }}</td>
                </tr>g
                <tr>
                    <th>Status</th>
                    <td>{{ $progress->status }}</td>
                </tr>
                <tr>
                    <th>Comment</th>
                    <td>{{ $progress->comment ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Created At</th>
                    <td>{{ \Carbon\Carbon::parse($progress->created_at)->format('d/m/Y H:i') }}</td>
                </tr>
            </table>



            <h5 class="mt-5 mb-3">Progress Images</h5>
            <div class="row">
                @forelse($progress->imageProgress as $image)

                @php
                $fileUrl = Storage::url($image->image);
                $fileExtension = pathinfo($fileUrl, PATHINFO_EXTENSION);
             @endphp

                @if(strtolower($fileExtension) === 'pdf')
                <!-- Tampilkan tombol unduhan jika file adalah PDF -->
                <a href="{{ $fileUrl }}" class="btn btn-primary" target="_blank">
                    Download PDF
                </a>
            @else
            <div class="d-flex justify-content-center my-3">
                <img src="{{ $fileUrl }}" alt="Progress Image" class="img-thumbnail" style="max-width: 300px; height: auto;">
            </div>


            @endif
                @empty
                    <p>Tidak ada gambar untuk progress ini.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>


@endsection
