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
        padding: 12px 24px;
        box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.15);
        transition: background-color 0.3s, color 0.3s, box-shadow 0.3s;
    }

    .btn:hover {
        background-color: #E8F0FE;
        color: #0B20E9;
        border: 2px solid #0B20E9;
    }

    .card {
        border-radius: 12px;
        background-color: #E8F0FE;
    }

    .card-header {
        background-color: #0B20E9;
        color: white;
        border-radius: 12px 12px 0 0;
        font-weight: bold;
        padding: 20px 30px;
    }

    .card-body {
        background-color: #FFFFFF;
        padding: 20px 30px;
        border-radius: 12px 12px 12px 12px;
    }

  .card1-body {
        background-color: #E8F0FE;
        border-radius: 10px 10px 10px 10px;
    }

    table {
        background-color: #FFFFFF;
        border-radius: 7px;
        width: 100%;
        margin-top: 20px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    th {
        background-color: #0B20E9;
        color: #E8F0FE;
        padding: 12px 15px;
        text-align: left;
    }

    td {
        padding: 10px 15px;
        border-bottom: 1px solid #ddd;
    }

    .card-body h6 {
        color: #0B20E9;
        font-weight: bold;
        margin-bottom: 15px;
    }

    .card-body p {
        font-size: 14px;
        color: #333;
        line-height: 1.6;
    }

    .row .card {
        margin-bottom: 20px;
    }
</style>

<div class="container mt-5">
    <div class="card-header">
        <h6 class="mb-0">Log Detail</h6>
    </div>
    <div class="card1-body p-5">
        <h5 class="mb-4" style="color: #0B20E9; font-weight: bold;">Log Information</h5>

        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6>Log Name</h6>
                        <p>{{ $log->log_name }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6>Description</h6>
                        <p>{{ $log->description }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body"
                         style="
                            background-color:
                            @if($log->event == 'created')
                                rgba(40, 167, 69, 0.2); /* Green with transparency for 'created' */
                            @elseif($log->event == 'updated')
                                rgba(255, 193, 7, 0.2); /* Yellow with transparency for 'updated' */
                            @elseif($log->event == 'deleted')
                                rgba(220, 53, 69, 0.2); /* Red with transparency for 'deleted' */
                            @elseif($log->event == 'viewed')
                                rgba(0, 123, 255, 0.2); /* Blue with transparency for 'viewed' */
                            @else
                                rgba(248, 249, 250, 0.2); /* Default transparent gray */
                            @endif;
                            color:
                            @if($log->event == 'created')
                                #28a745 !important; /* Solid green for 'created' */
                            @elseif($log->event == 'updated')
                                #ffc107 !important; /* Solid yellow for 'updated' */
                            @elseif($log->event == 'deleted')
                                #dc3545 !important; /* Solid red for 'deleted' */
                            @elseif($log->event == 'viewed')
                                #007bff !important; /* Solid blue for 'viewed' */
                            @else
                                #6c757d !important; /* Solid gray for default */
                            @endif;
                            font-weight: bold !important;">
                        <h6>Event</h6>
                        <p>{{ ucfirst($log->event) }}</p>
                    </div>
                </div>
            </div>




            <div class="col-md-6 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6>Created At</h6>
                        <p>{{ $log->created_at }}</p>
                    </div>
                </div>
            </div>

            @if ($log->event === 'updated' || $log->event === 'created' || $log->event === 'deleted')
                <div class="col-md-12 mb-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h6>Data</h6>
                            @if (isset($log->properties['old']))
                                <h6 class="mt-3">Old</h6>
                                <ul>
                                    @foreach($log->properties['old'] as $key => $value)
                                        <li><strong>{{ ucfirst($key) }}:</strong> {{ $value }}</li>
                                    @endforeach
                                </ul>
                            @endif
                            @if (isset($log->properties['attributes']))
                                <h6 class="mt-3">Attributes</h6>
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
