@extends('layouts.admin1')

@section('title')
    Project 
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            @if ($errors->any())
                <div class="alert alert-danger">

                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card shadow border-0 p-3 mb-5" style="border-radius: 20px;">
                <div class="card-body">
                    <h1>Detail Projects</h1>
                </div>
            </div>
        </div>
    </div>


@endsection
