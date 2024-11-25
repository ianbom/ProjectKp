@extends('layouts.admin1')

@section('title', 'Task List')

@section('content')
    <style>
        body {
            background: linear-gradient(to bottom right, #CED2FB, #E8E9FF);
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }

        .card {
            background-color: #E8F0FE; /* Warna background card */
            border-radius: 7px;
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 12px 20px rgba(0, 0, 0, 0.2);
        }

        .btn:hover {
            background-color: #E8F0FE; /* Warna background button */
            color: #0B20E9; /* Warna font button */
            font-weight: 500;
            border: 2px solid #0B20E9;
            border-radius: 7px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s, box-shadow 0.3s;
        }

        .btn {
            background-color: #0B20E9; /* Warna hover button */
            color: #FFFFFF;
            box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.15);
        }

        table {
            border-collapse: separate;
            border-spacing: 0;
            background-color: #FFFFFF; /* Warna background tabel */
        }

        table thead {
            background-color: #0B20E9; /* Warna background header tabel */
            color: #FFFFFF; /* Warna font header tabel */
        }

        table tbody tr {
            background-color: #F5F7FF; /* Warna background baris */
            color: #0B20E9; /* Warna font isi tabel */
            transition: background-color 0.3s, color 0.3s;
        }

        table tbody tr:hover {
            background-color: #0B20E9; /* Warna background saat hover */
            color: #FFFFFF; /* Warna font saat hover */
        }

        th, td {
            vertical-align: middle;
            padding: 12px;
            border: 1px solid #E8E9FF;
            text-align: center; /* Rata tengah */
        }

        th {
            font-size: 14px;
            font-weight: bold;
        }

        td {
            font-size: 14px;
        }
    </style>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow border-0 p-3">
                <div class="card-body">
                    <a href="{{ route('task.create') }}" class="btn mb-3 px-4 py-2">
                        + Tambah Task Baru
                    </a>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="taskTable">
                            <thead>
                                <tr>
                                    <th class="text-center">ID Task</th>
                                    <th class="text-center">Project</th>
                                    <th class="text-center">User</th>
                                    <th class="text-center">Title</th>
                                    <th class="text-center">Description</th>
                                    <th class="text-center">Created At</th>
                                    <th class="text-center">Updated At</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Data fetched dynamically --}}
                            </tbody>
                        </table>
                    </div>
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

