@extends('layouts.karyawan')

@section('title', 'Create Progress Task')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">


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


            <h4 class="card-title">Tambah Progress untuk Task: {{ $task->title }}</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('karyawan.progress.store', $task->id_task) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="id_task" class="form-label">Task ID</label>
                    <input type="text" class="form-control" id="id_task" name="id_task" value="{{ $task->id_task }}" readonly>
                </div>

                <input type="hidden" name="id" value="{{ Auth::id() }}">

                <!-- Description -->
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi Progress</label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="4" required>{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Status (read-only) -->
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <input type="text" class="form-control" id="status" name="status" value="On-Going" readonly>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Upload Images/PDF</label>
                    <input type="file" name="image[]" id="image" class="form-control" multiple accept="image/jpeg,image/png,application/pdf">
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Simpan Progress</button>
                <a href="{{ route('karyawan.task.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
