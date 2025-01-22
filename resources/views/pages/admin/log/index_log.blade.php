@extends('layouts.admin1')

@section('title')
    Log
@endsection
@php
use Carbon\Carbon;
@endphp

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

        .btn {
            background-color: #0B20E9;
            color: #FFFFFF;
            box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.15);
        }

        .btn:hover {
            background-color: #E8F0FE;
            color: #0B20E9;
            font-weight: 500;
            border: 2px solid #0B20E9;
            border-radius: 7px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s, box-shadow 0.3s;
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
    </style>

    <div class="row">
        <div class="col-md-12">
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
            <div class="card shadow border-0 p-3">
                <div class="card-body">
                    <h5 class="text-primary">Log Aktivitas</h5>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="crudTable">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Log Name</th>
                                    <th class="text-center">Description</th>
                                    <th class="text-center">Event</th>
                                    <th class="text-center">Subject Type</th>
                                    <th class="text-center">Causer Name</th>
                                    <th class="text-center">Timestamp</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($log as $index => $entry)
                                    <tr>
                                        <td>{{ $index + 1}}</td>

                                        <td>{{ $entry->log_name }}</td>
                                        <td>{{ $entry->description }}</td>
                                        <td>{{ $entry->event }}</td>
                                        <td>{{ $entry->subject_type }}</td>
                                        <td>{{ $entry->user_name ?? 'System' }}</td>
                                        <td>{{  Carbon::parse($entry->created_at)->translatedFormat('d F Y') }}</td>
                                        <td><a href="{{ route('log.show', $entry->id) }}" class="btn btn-info"> Detail</a></td>
                                    </tr>
                                @endforeach
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
        $(document).ready(function() {
            $('#crudTable').DataTable({
                order:[[0, 'desc']]
            })});
    </script>
@endpush
