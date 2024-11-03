@extends('layouts.karyawan')

@section('title', 'Edit Progress Karyawan')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Progress Karyawan</h4>
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

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        </div>
        <div class="card-body">
            <form action="{{ route('karyawan.progress.update', $progress->id_progress_task) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control" required>{{ old('deskripsi', $progress->deskripsi) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="On-Going" {{ $progress->status === 'On-Going' ? 'selected' : '' }}>On-Going</option>
                        <option value="Completed" {{ $progress->status === 'Completed' ? 'selected' : '' }}>Completed</option>
                        <option value="Revisi" {{ $progress->status === 'Revisi' ? 'selected' : '' }}>Revisi</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="comment" class="form-label">Comment</label>
                    <textarea name="comment" id="comment" class="form-control">{{ old('comment', $progress->comment) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Upload Image/PDF</label>
                    <input type="file" name="image[]" id="image" class="form-control" accept=".jpg, .jpeg, .png, .pdf" multiple>
                    <small class="form-text text-muted">Supported formats: JPG, PNG, PDF. You can upload multiple files.</small>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Update Progress</button>
                    <a href="{{ route('karyawan.task.detail', $progress->task->id_task) }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>

                <h5 class="mt-4">Current Images/PDFs</h5>
                <div class="row">
          @foreach ($progress->imageProgress as $image)
                 <div class="col-md-4 mb-3 text-center">
                   @if (pathinfo($image->image, PATHINFO_EXTENSION) === 'pdf')
                <a href="{{ Storage::url($image->image) }}" target="_blank" class="btn btn-outline-primary mb-2">Download PDF</a>
                    @else
                <img src="{{ Storage::url($image->image) }}" alt="Progress Image" class="img-thumbnail" style="max-width: 200px;">
            @endif
            <form action="{{ route('karyawan.imageProgress.delete', $image->id_task_image) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this file?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm mt-2">Delete</button>
            </form>
        </div>
    @endforeach
</div>




        </div>
    </div>
</div>


@endsection
