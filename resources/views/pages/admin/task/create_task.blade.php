@extends('layouts.admin1')

@section('title')
    Create Task
@endsection

@section('content')

    {{-- <div class="dashboard-heading">
        <h2 class="dashboard-title font-weight-bolder">Add New Client</h2>

    </div> --}}

    <div class="container mt-4">
        <h2>Create New Task</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('task.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Dropdown for selecting project (nullable) -->
            <div class="mb-3">
                <label for="id_projects" class="form-label">Select Project (Optional)</label>
                <select name="id_projects" id="id_projects" class="form-select">
                    <option value="">None</option>
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Dropdown for selecting user (required) -->
            <div class="mb-3">
                <label for="id" class="form-label">Assign to User</label>
                <select name="id" id="id" class="form-select" required>
                    <option value="">Select User</option>
                    @foreach($user as $u)
                        <option value="{{ $u->id }}">{{ $u->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Input for Task Title (required) -->
            <div class="mb-3">
                <label for="title" class="form-label">Task Title</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="Enter task title" required>
            </div>

            <!-- Textarea for Task Description (required) -->
            <div class="mb-3">
                <label for="description" class="form-label">Task Description</label>
                <textarea name="description" id="description" class="form-control" rows="5" placeholder="Enter task description" required></textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Upload Images</label>
                <input type="file" name="image[]" id="image" class="form-control" multiple accept="image/jpeg,image/png,application/pdf">
            </div>


            <!-- Submit button -->
            <button type="submit" class="btn btn-primary">Create Task</button>
        </form>
    </div>

@endsection
