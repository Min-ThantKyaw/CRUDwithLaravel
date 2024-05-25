@extends('master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6 offset-3 mt-5 shadow-sm">

                <h3>{{ $post['title'] }}</h3>
                <hr>
                <p class=" text-muted">{{ $post['description'] }}</p>

            </div>

        </div>
        <div class="row">
            <div class="col-5 offset-7 mt-2">
                <a href="{{ route('post#home') }}"> <button class="btn btn-success"><i class="fa-solid fa-backward">
                        </i>Back</button></a>
                <a href="{{ route('post#edit', $post['id']) }} "><button class="btn btn-success">Edit</button></a>
            </div>
        </div>
    </div>
