@extends('layouts.admin1')

@section('title')
    Client
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
                    <a href="{{ route('client.create') }}" class="btn mb-3 px-4 py-2">
                        + Tambah Klien Baru
                    </a>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="crudTable">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Nama Klien</th>
                                    <th class="text-center">Slug</th>
                                    <th class="text-center">Password Page</th>
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


@push('addon-script')
    <script>
        var datatable = $('#crudTable').DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: {
                url: '{!! url()->current() !!}',
            },
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'slug',
                    name: 'slug'
                },
                {
                    data: 'password',
                    name: 'password'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    width: '20%',
                },
            ]
        });
    </script>
@endpush
