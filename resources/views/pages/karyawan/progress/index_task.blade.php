@extends('layouts.karyawan')

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
<div class="container mt-5">
    <div class="card">
        <div class="card-header" style="background-color: #0B20E9; color:#FFFFFF; padding-top:20px;">
            <h6 class="card-title">Daftar Task Karyawan</h6>
        </div>
        <div class="card-body">
            @if($task->isEmpty())
                <p class="text-center">Tidak ada task untuk ditampilkan.</p>
            @else
                <div class="table-responsive">
                    <table id="table-1" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID Task</th>
                                <th>Project</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($task as $item)
                                <tr>
                                    <td>{{ $item->id_task }}</td>
                                    <td>{{ $item->projects->name ?? 'No Project Assigned' }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('j F Y') }}</td>
                                    <td>
                                        <a href="{{ route('karyawan.task.detail', $item->id_task) }}" class="btn btn-success">Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>

{{-- <script src="https://cdn.datatables.net/2.1.4/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.4/js/dataTables.bootstrap5.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.3.1/js/dataTables.fixedHeader.min.js"></script> --}}



@endsection

@push('addon-script')
<script>
    $(document).ready(function() {
           $('#table-1').DataTable({
               responsive: true,
           });
       });
</script>
@endpush

