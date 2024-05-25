@extends('master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6 offset-3 mt-5">



                {{-- <h3>{{ $post[0]['title'] }}</h3>
                <p class=" text-muted">{{ $post[0]['description'] }}</p> --}}
                @if (session('insertSuccess'))
                    <div class="alert">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>{{ session('insertSuccess') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif
                <form action="{{ route('updatePage') }}" class="form-control" method="post">
                    @csrf
                    <input type="hidden" name="postId" value="{{ $post['id'] }}">
                    <input type="text" class="form-control" value="{{ $post['title'] }}" name="postTitle">
                    @error('postTitle')
                        <small class="text-danger"> {{ $message }}</small>
                    @enderror
                    <textarea name="postDescription" class="form-control"> {{ $post['description'] }}</textarea>
                    @error('postDescription')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <button class="btn btn-success" type="submit">Update</button>
                    <a href="{{ route('post#update', $post['id']) }}"> <button class="btn btn-success" type="button"><i
                                class="fa-solid fa-backward">
                            </i>Back</button></a>
                </form>

            </div>

        </div>

    </div>
