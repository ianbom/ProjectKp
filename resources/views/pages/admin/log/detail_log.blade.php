@extends('layouts.admin1')

@section('title', 'Log Detail')

@section('content')
<style>
    .btn {
        background-color: #0B20E9;
        color: #FFFFFF;
        font-weight: 500;
        border: none;
        border-radius: 7px;
        padding: 10px 20px;
        box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.15);
        transition: background-color 0.3s, color 0.3s, box-shadow 0.3s;
    }

    .btn:hover {
        background-color: #E8F0FE;
        color: #0B20E9;
        border: 2px solid #0B20E9;
    }

    .card {
        border-radius: 10px;
        background-color: #E8F0FE;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    .card1 {
        border-radius: 10px;
        background-color: #FFFFFF;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background-color: #0B20E9;
        color: white;
        border-radius: 10px 10px 0 0;
        font-weight: bold;
        padding-bottom: 10px;
        padding-top: 20px;
    }

    .card-body {
        background-color: #FFFFFF;
        border-radius: 10px;
    }

    table {
        background-color: #FFFFFF;
        border-radius: 7px;
    }

    th {
        background-color: #0B20E9;
        color: #E8F0FE;
    }
</style>

<div class="container mt-5">
    <div class="card-header">
        <h6 class="mb-0">Log Detail</h6>
    </div>
    <div class="card-body p-5">
        <h5 class="mb-4" style="color: #0B20E9; font-weight: bold;">Log Information</h5>

        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 style="color: #0B20E9; font-weight: bold;">Log Name</h6>
                        <p>{{ $log->log_name }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 style="color: #0B20E9; font-weight: bold;">Description</h6>
                        <p>{{ $log->description }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 style="color: #0B20E9; font-weight: bold;">Event</h6>
                        <p>{{ ucfirst($log->event) }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 style="color: #0B20E9; font-weight: bold;">Created At</h6>
                        <p>{{ $log->created_at }}</p>
                    </div>
                </div>
            </div>

            @if ($log->event === 'updated' || $log->event === 'created' || $log->event === 'deleted')
                <div class="col-md-12 mb-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h6 style="color: #0B20E9; font-weight: bold;">Data</h6>
                            @if (isset($log->properties['old']))
                                <h6 class="mt-3" style="color: #0B20E9; font-weight: bold;">Old</h6>
                                <ul>
                                    @foreach($log->properties['old'] as $key => $value)
                                        <li><strong>{{ ucfirst($key) }}:</strong> {{ $value }}</li>
                                    @endforeach
                                </ul>
                            @endif
                            @if (isset($log->properties['attributes']))
                                <h6 class="mt-3" style="color: #0B20E9; font-weight: bold;">Attributes</h6>
                                <ul>
                                    @foreach($log->properties['attributes'] as $key => $value)
                                        <li><strong>{{ ucfirst($key) }}:</strong> {{ $value }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

        </div>

        <div class="mt-5">
            <a href="{{ route('log.index') }}" class="btn">Back to Logs</a>
        </div>
    </div>
</div>
@endsection
