@extends('layouts.admin1')

@section('title')
    Video Tutorial
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

        .btn {
            background-color: #0B20E9; /* Warna tombol */
            color: #FFFFFF;
            font-weight: 500;
            border: none;
            border-radius: 7px;
            padding: 10px 20px;
            box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.15);
            transition: background-color 0.3s, color 0.3s, box-shadow 0.3s;
        }

        .btn:hover {
            background-color: #E8F0FE; /* Warna tombol saat hover */
            color: #0B20E9;
            border: 2px solid #0B20E9;
        }

        table {
            border-collapse: separate;
            border-spacing: 0;
            background-color: #FFFFFF;
        }

        table thead {
            background-color: #0B20E9; /* Warna header tabel */
            color: #FFFFFF;
        }

        table tbody tr {
            background-color: #F5F7FF; /* Warna baris tabel */
            color: #0B20E9;
            transition: background-color 0.3s, color 0.3s;
        }

        table tbody tr:hover {
            background-color: #0B20E9; /* Warna hover baris tabel */
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

        img {
            border-radius: 7px;
        }  /* Button and Dropdown Styles (matching Task Page) */
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

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow border-0 p-4">
                <div class="card-body">
                    <!-- Tombol Tambah Video -->
                    <div class="mb-4">
                        <a href="{{ route('tutorial.create') }}" class="btn mb-3 px-4 py-2">
                            + Tambah Video Tutorial Baru
                        </a>
                    </div>

                    <!-- Tabel -->
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="crudTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Thumbnail</th>
                                    <th>Title</th>
                                    <th>Duration</th>
                                    <th>Author</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Contoh data dummy -->
                                <tr>
                                    <td>1</td>
                                    <td><img src="/path/to/thumbnail.jpg" alt="Thumbnail" style="width: 80px;"></td>
                                    <td>Introduction to Programming</td>
                                    <td>10:15</td>
                                    <td>John Doe</td>
                                    <td>
                                        <button class="btn btn-sm"
                                                style="background-color: #FFA500; color: #FFFFFF; border-radius: 7px;">
                                            Edit
                                        </button>
                                        <button class="btn btn-sm"
                                                style="background-color: #FF4D4D; color: #FFFFFF; border-radius: 7px;">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                                <!-- End data dummy -->
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
                    data: 'url_thumbnail',
                    name: 'url_thumbnail'
                },
                {
                    data: 'title',
                    name: 'title'
                },

                {
                    data: 'duration',
                    name: 'duration'
                },
                {
                    data: 'author',
                    name: 'author'
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
