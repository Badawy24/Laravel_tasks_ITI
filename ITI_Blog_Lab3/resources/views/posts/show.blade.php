@extends('layouts.app')
@section('title')
    show
@endsection
@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show w-25 text-center mx-auto mt-2" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card mt-4">
        <div class="card-header">
            Post Info
        </div>
        <div class="card-body">
            <h5 class="card-title">Title: {{ $post->title }}</h5>
            <h5 class="card-text">Description: </h5>
            <p>{{ $post->description }}</p>
        </div>
    </div>
    <div class="card mt-4">
        <div class="card-header">
            Post Creator Info
        </div>
        <div class="card-body">
            <h5 class="card-title">Name: {{ $post->user->name }}</h5>
            <h5 class="card-title">Email: {{ $post->user->email }}</h5>
            {{-- <p class="card-text">Created At: {{ $post->created_at->format('l jS \o\f F Y h:i:s a') }}</p> --}}
            <p class="card-text">Created At: {{ $post->created_at }}</p>
        </div>
    </div>


    <div class="card mt-4">
        <div class="card-header">
            Comments
        </div>
        <div class="card-body">

            <!-- Add Comment Form -->
            <form method="POST" action="{{ route('posts.comments', $post->id) }}">
                @csrf
                <div class="mb-3">
                    <textarea name="body" class="form-control" rows="2" placeholder="Add a comment"></textarea>
                    @error('body')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <button class="btn btn-primary btn-sm">Add Comment</button>
            </form>

            <hr>

            <!-- Display Comments -->
            @foreach ($post->comments as $comment)
                <div class="card mb-2">
                    <div class="card-body d-flex justify-content-between align-items-start">
                        <div>
                            {{-- <small class="text-muted">{{ $comment->created_at->format('l d/m/Y h:i A') }}</small> --}}
                            <small class="text-muted">{{ $comment->created_at }}</small>
                            <p>{{ $comment->body }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
