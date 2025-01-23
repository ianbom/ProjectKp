@extends('layouts.admin1')

@section('title')
    Project {{ $client->name }}
@endsection

@section('content')
    <style>
        body {
            background: linear-gradient(to bottom right, #CED2FB, #E8E9FF);
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }

        .card {
            background-color: #E8F0FE;
            border-radius: 7px;
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 12px 20px rgba(0, 0, 0, 0.2);
        }

        table {
            border-collapse: separate;
            border-spacing: 0;
            background-color: #FFFFFF;
        }

        table thead {
            background-color: #0B20E9;
            color: #FFFFFF;
        }

        table tbody tr {
            background-color: #F5F7FF;
            color: #0B20E9;
            transition: background-color 0.3s, color 0.3s;
        }

        table tbody tr:hover {
            background-color: #0B20E9;
            color: #FFFFFF;
        }

        th, td {
            vertical-align: middle;
            padding: 12px;
            border: 1px solid #E8E9FF;
            text-align: center;
        }

        th {
            font-size: 14px;
            font-weight: bold;
        }

        td {
            font-size: 14px;
        }

        .btn.dropdown-toggle {
            background-color: #0B20E9;
            color: white;
            border-radius: 7px;
            border: none;
            padding: 8px 20px;
            box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.15);
            transition: background-color 0.3s, box-shadow 0.3s;
        }

        .btn.dropdown-toggle:hover {
            background-color: #E8F0FE;
            color: #0B20E9;
            border: 2px solid #0B20E9;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .dropdown-menu {
            background-color: #E8F0FE;
            border-radius: 7px;
            box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.1);
        }

        .dropdown-item {
            color: #0B20E9;
        }

        .dropdown-item:hover {
            background-color: #0B20E9;
            color: white;
        }
    </style>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow border-0 p-3">
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
                <div class="card-body">
                    <a href="{{ route('client.project.create', $client->id) }}" class="btn btn-primary mb-3" style="background-color: #0B20E9; color: white; border-radius: 7px;">
                        + Tambah Project Baru <strong>(Klien {{ $client->name }})</strong>
                    </a>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="crudTable">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Project</th>
                                    <th class="text-center">Jenis Project</th>
                                    <th class="text-center">Deadline</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script>
        $(document).ready(function() {
            $('#crudTable').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
            order: [[0, 'desc']],
                ajax: {
                    url: '{!! url()->current() !!}',
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'jenis', name: 'jenis' },
                    { data: 'deadline', name: 'deadline' },
                    { data: 'status', name: 'status' },
                    { data: 'action', name: 'action', orderable: false, searchable: false, width: '20%' },
                ]
            });
        });
    </script>
@endpush
