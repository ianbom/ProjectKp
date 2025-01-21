@extends('layouts.app')

@section('title')
    Client Portal Video Tutorial
@endsection

@section('content')
<head>
    <style>
        .video-container {
    width: 50%;
    margin-bottom: 20px;
}

@media (max-width: 768px) {
    .video-container {
        width: 100%; /* Lebar penuh pada layar kecil */
    }
}

    </style>
</head>
    {{-- <section class="">
        <div class="bg-tutorials">
            <div class="container">
                <p class="my-auto text-white title-tutorial font-weight-bold">Tutorial</p>
            </div>
        </div>

        @foreach ($tutorial as $tutorials)
            <div class="d-flex justify-content-center video mt-lg-3 mt-md-3 mt-sm-2">
                <div class="bg-tutorial">
                    <div class="d-flex justify-content-center">
                        <iframe src="{{ $tutorials->link }}" title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen></iframe>
                    </div>
                    <div class="ml-3 mt-2">
                        <h5 class="font-weight-normal font-title">{{ $tutorials->title }}</h5>
                        <p class="font-weight-light font-author">By {{ $tutorials->author }}</p>
                    </div>
                </div>

            </div>
        @endforeach
        <div class="d-flex justify-content-center video mt-lg-3 mt-md-3 mt-sm-2">
            <div class="bg-tutorial">
                <div class="d-flex justify-content-center">
                    <iframe src="https://www.youtube.com/embed/SKh50WHPxk0?si=IAR4cEpYnRDvPd8X" title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe>
                </div>
                <div class="ml-3 mt-2">
                    <h5 class="font-weight-normal font-title">Tutorial tambah produk toko online</h5>
                    <p class="font-weight-light font-author">By admin</p>
                </div>
            </div>

        </div>
    </section> --}}

    <section>
        <div class="d-flex" style="border-radius: 7px; margin: 20px 40px; background-color: #E8F0FE;">
            <div class="bg-comments">
                <p class="my-auto title-comment font-weight-bold">Tutorials</p>
            </div>
        </div>

        <div class="d-flex flex-wrap justify-content-between" style="padding: 20px; margin: 20px 40px; background-color: #E8F0FE; border-radius: 7px;">
            @if(count($tutorial) > 0)
                @foreach ($tutorial as $tutorials)
                    <div class="video-container" style="flex-basis: 50%; padding: 10px;">
                        <div class="bg-tutorial" style="background-color: white; border-radius: 10px; padding: 15px;">
                            <div class="d-flex justify-content-center" style="border-radius: 10px; overflow: hidden;">
                                {!! $tutorials->embed_html !!}
                            </div>
                            <div class="mt-3">
                                <h6 class="font-weight-normal font-title">{{ $tutorials->title }}</h6>
                                <p class="font-weight-light font-author">By {{ $tutorials->author }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
            <div class="video-container" style="flex-basis: 50%; padding: 10px;">
                <div class="bg-tutorial" style="background-color: white; border-radius: 10px; padding: 15px; text-align: center;">
                    <!-- Video -->
                    <div style="border-radius: 10px; overflow: hidden; display: flex; justify-content: center;">
                        <iframe src="https://www.youtube.com/embed/SKh50WHPxk0?si=IAR4cEpYnRDvPd8X"
                            title="YouTube video player"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen>
                        </iframe>
                    </div>

                    <!-- Title and Author -->
                    <div class="mt-3" style="display: flex; flex-direction: column; align-items: center;">
                        <h6 class="font-weight-semobild font-title" style="font-size: 18px; margin-bottom: 5px;">Cara Install Wordpress di Localhost Menggunakan Xampp</h6>
                        <p class="font-weight-light font-author" style="margin: 0;">By Installasi wordpress 2</p>
                    </div>
                </div>
            </div>


            @endif
        </div>
    </section>




@endsection
