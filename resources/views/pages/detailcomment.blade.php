@extends('layouts.app')

@section('title')
    Client Portal Comments - {{ $client->name }}
@endsection

@section('content')
   

    <section class="">
        <div class="d-flex" style="border-radius: 7px; margin: 20px 40px; background-color: #E8F0FE; ">
        <div class="bg-comments">
                <p class="my-auto title-comment font-weight-bold">Comment</p>
            </div>
        </div>

        <!-- ADDING COMMENT -->
                <div class="d-flex" style="border-radius: 7px; margin: 20px 40px; background-color: #E8F0FE; ">


        <div class=" bg-comment p-5" >

            @comments(['model' => $client])
        </div>


    </section>
@endsection
