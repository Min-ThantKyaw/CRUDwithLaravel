@extends('master');
@section('content')
    <div class="container">
        <div class="row mt-2">
            <div class="col-5 shadow-sm rounded-3">
                <div class="p-3">
                    @if (session('insertSuccess'))
                        <div class="alert">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>{{ session('insertSuccess') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    <form action="{{ route('post#create') }}" method="POST" class=" p-3" enctype="multipart/form-data">
                        @csrf

                        <div class="text-group mb-3 rounded">
                            <label for="">Post Title</label>
                            <input type="text" class=" form-control" name="postTitle" value="{{ old('postTitle') }}"
                                placeholder="Enter Post Title...">
                            @error('postTitle')
                                <small class="text-danger"> {{ $message }}</small>
                            @enderror
                        </div>
                        <div class="text-group mb-3">
                            <label for="">Post Description</label>
                            <textarea class=" form-control" name="postDescription" placeholder="Enter Post Description...">
                                {{ old('postDescription') }}
                            </textarea>
                            @error('postDescription')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="text-group mb-3">
                            <label for="">Image</label>
                            <input type="file" name="postImage" placeholder="Enter Your Image">
                        </div>

                        <div class="">
                            <input type="submit" value="Create" class="btn btn-danger">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-7 ">
                <div class="datacontainer">
                    {{-- Data Searching --}}
                    <form action="{{ route('post#createPage') }}" method="GET">
                        <div class="mb-3 d-flex">
                            <input type="text" class="form-control" name="searchKey" id=""
                                placeholder="Enter key to search...">
                            <button type="submit" class="btn btn-success">Search</button>
                        </div>
                    </form>
                    @foreach ($posts as $post)
                        <div class="post p-3 shadow-lg mb-3 rounded-3">
                            <h5>{{ $post['title'] }}</h5>
                            <p class="text-muted">{{ Str::words($post['description'], 10, '...') }}</p>
                            <img src="" alt="">
                            <div class="text-end">
                                <a href="{{ route('post#delete', $post['id']) }}"> <button class="btn btn-sm btn-danger"><i
                                            class="fa-solid fa-trash">Delete</i></button></a>
                                <a href="{{ route('post#update', $post['id']) }}"> <button
                                        class="btn btn-sm btn-primary"><i class="fa-solid fa-circle-info">SeeMore..
                                        </i></i></button></a>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
            {{ $posts->appends(request()->query())->links() }}
        </div>
    </div>
@endsection
