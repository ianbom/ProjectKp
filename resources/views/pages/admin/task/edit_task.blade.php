@extends('layouts.admin1')

@section('title', 'Edit Task')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h1>Admin Edit Task</h1>

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
        </div>
        <div class="card-body">
            <form action="{{ route('task.update', $task->id_task) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="id_projects" class="form-label">Project</label>
                    <select class="form-select" id="id_projects" name="id_projects">
                        <option value="">No Project</option>
                        @foreach($projects as $project)
                            <option value="{{ $project->id }}" {{ $task->id_projects == $project->id ? 'selected' : '' }}>
                                {{ $project->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="id" class="form-label">User ID</label>
                    <select class="form-select" id="id" name="id" required>
                        @foreach($user as $u)
                            <option value="{{ $u->id }}" {{ $task->id == $u->id ? 'selected' : '' }}>
                                {{ $u->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $task->title }}" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required>{{ $task->description }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Upload New Images</label>
                    <input type="file" class="form-control" id="image" name="image[]" multiple>
                    <small class="text-muted">You can upload multiple images. Allowed formats: jpeg, png, jpg, pdf.</small>
                </div>

                <button type="submit" class="btn btn-primary">Update Task</button>
                <a href="{{ route('task.index') }}" class="btn btn-secondary">Cancel</a>
            </form>

            <div class="mb-3">
                <label for="current_images" class="form-label">Current Images</label>
                <div class="d-flex flex-wrap">
                    @if($task->imageTask && $task->imageTask->isNotEmpty())
                        @foreach($task->imageTask as $image)
                            <div class="m-2">
                                @if(pathinfo($image->image, PATHINFO_EXTENSION) === 'pdf')
                                    <p>{{ $image->image }}</p>
                                    <a href="{{ asset('storage/' . $image->image) }}" target="_blank" class="btn btn-primary">
                                        Download PDF
                                    </a>
                                @else
                                    <img src="{{ asset('storage/' . $image->image) }}" alt="Task Image" width="100" height="100">
                                @endif
                                <!-- Tombol Delete -->
                                <form action="{{ route('image.task.delete', $image->id_task_image) }}" method="POST" class="mt-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        @endforeach
                    @else
                        <p>No images available</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
