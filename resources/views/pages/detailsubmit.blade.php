@extends('layouts.apprevamp')

@section('title')
    {{ $client->name }} - Portal Client
@endsection

<style>
    /* Default button styles */
    .btn-custom {
    background-color: #838cec; /* Set the button color */
    color: white; /* Set the text color */
    border: none;
    padding: 6px;
    border-radius: 4px; /* Add border radius */
    transition: background-color 0.3s, color 0.3s;
}


    /* Hover effect for the button */
    .btn-custom:hover {
        background-color: #CED2FB; /* Change background color on hover */
    }
</style>

@section('content')
    <!-- Background Wrapper -->
    <div style="background-image: url('{{ asset('images/portal-client/background2.png') }}'); background-size: cover; background-position: center; background-repeat: no-repeat; min-height: 100vh; width: 100%; display: flex; align-items: center; justify-content: center;">

        <!-- Profile Photo -->
        <div class="profile-photo" style="width: 350px; height: 350px; border-radius: 50%; overflow: hidden; position: absolute; top: 20%; right: 10%; ">
            <img src="{{ asset('images/portal-client/projectclient.png') }}" alt="Profile Photo" style="width: 100%; height: 100%; object-fit: cover;">
        </div>

        <!-- Circle Decoration -->
        <div class="circle-decoration" style="width: 30px; height: 30px; border: 5px solid #fcdb38; border-radius: 50%; position: absolute; top: 18%; right: 20%;"></div>
        <div class="circle-decoration" style="width: 90px; height: 90px; border: 4px solid #fffFFF; border-radius: 50%; position: absolute; top: 10%; right: 10%;"></div>

        <section class="store-heading">
            <div class="container">
                <div class="mobile-card-1 d-flex flex-row justify-content-between" style="margin-top: 25vh; margin-bottom: 25vh;">
                    <div class="d-flex flex-row justify-content-between p-card-1 bg-transparent">
                        <div class="mobile-card-1 d-flex justify-content-center align-items-center">
                            <div>
                                <h2 class="h2-contact text-white">Hello, {{ $client->name }}</h2>
                                <p class="p-contact mb-3 text-white">
                                    Masukkan password yang sudah diberikan admin
                                </p>
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                <form action="/details/{{ $client->slug }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="password" name="password" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col text-left">
                                            <button type="submit" class="btn-custom px-5">
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-row justify-content-between p-card-2 bg-white" style="position: relative; z-index: 10; margin-right: 230px; margin-left: 100px; width: 140px; height: 110px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                        <div class="section-1-card-2 p-2 d-flex justify-content-center align-items-center">
                            <p class="font-number h4" style="color: #0B20E9; font-size: 2.3rem;">{{ $projecttotal }}</p>
                        </div>
                        <div class="section-2-card-2 d-flex justify-content-center align-items-center">
                            <p class="font-project text-gray h6" style="font-size: 0.8rem;">Jumlah Project</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
