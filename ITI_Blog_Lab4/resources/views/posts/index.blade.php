@extends('layouts.app')
@section('title')
    index
@endsection

{{-- @section('counter')
    <a class="btn btn-primary position-relative" href="{{ route('posts.index') }}">
        New
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            {{ $newPostsCount }}
        </span>
    </a>
@endsection --}}

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show w-25 text-center mx-auto mt-2" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="text-center">
        <a type="button" href="{{ route('posts.create') }}" class="btn btn-success m-4">Create Post</a>
        <table class="table mt-4">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Image</th>
                    <th scope="col">Title</th>
                    <th scope="col">Posted By</th>
                    <th scope="col">Created AT</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($posts as $post)
                    <tr>
                        <th scope="row">{{ $post->id }}</th>
                        <td>
                            @if ($post->image)
                                <img src="{{ $post->image_url }}" alt="Post Image" width="80" class="rounded">
                            @else
                                <span class="text-muted">No Image</span>
                            @endif
                        </td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->user->name }}</td>
                        {{-- <td>{{ $post->created_at->format('Y-m-d') }}</td> --}}
                        <td>{{ $post->created_at }}</td>
                        <td>
                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-info">View</a>
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary">Edit</a>
                            <form class="d-inline" method="POST" action="{{ route('posts.destroy', $post->id) }}"
                                onsubmit="return confirm('Are you sure to delete this post?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>

                        </td>

                    </tr>
                @endforeach


            </tbody>
        </table>
        {{ $posts->links('pagination::bootstrap-5') }}

    </div>
@endsection
