@extends('layouts.admin1')

@section('title', 'All Projects')

@section('content')
<div class="container mt-5">
    <h1>All Projects</h1>
    <table class="table table-bordered" id="projects-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Type</th>
                <th>Description</th>
                <th>Deadline</th>
                <th>Status</th>
                <th>Active Until</th>
                <th>Notes</th>
                <th>Photo</th>
                <th>Actions</th>
            </tr>
        </thead>
    </table>
</div>
@endsection


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    $('#projects-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('projects.data') }}",
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'jenis', name: 'jenis' },
            { data: 'keterangan', name: 'keterangan' },
            { data: 'deadline', name: 'deadline' },
            { data: 'status', name: 'status' },
            { data: 'masaaktif', name: 'masaaktif' },
            { data: 'notes', name: 'notes' },
            { data: 'photo', name: 'photo', orderable: false, searchable: false },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });
});
</script>

