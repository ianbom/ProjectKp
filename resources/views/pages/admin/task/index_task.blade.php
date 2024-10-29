@extends('layouts.admin1')

@section('title', 'Task List')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Daftar Task <a href="{{ route('task.create') }}">Create Task</a></h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="taskTable">
                    <thead>
                        <tr>
                            <th>ID Task</th>
                            <th>Project</th>
                            <th>User</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#taskTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('data.task') }}",
            columns: [
                { data: 'id_task', name: 'id_task' },
                { data: 'project_name', name: 'project_name' },
                { data: 'user_name', name: 'user_name' },
                { data: 'title', name: 'title' },
                { data: 'description', name: 'description' },
                {
                    data: 'created_at',
                    name: 'created_at',
                    render: function(data) {
                        return new Date(data).toLocaleString();
                    }
                },
                {
                    data: 'updated_at',
                    name: 'updated_at',
                    render: function(data) {
                        return new Date(data).toLocaleString();
                    }
                },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    });
</script>

