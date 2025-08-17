@extends('layouts.app')
@section('title')
    index
@endsection
@section('content')
    <div class="text-center">
        <a type="button" href="{{ route('posts.create') }}" class="btn btn-success m-4">Create Post</a>
        <table class="table mt-4">
            <thead>
                <tr>
                    <th scope="col">#</th>
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
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->user->name }}</td>
                        <td>{{ $post->created_at->format('Y-m-d') }}</td>
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
        {{ $posts->links() }}

    </div>
@endsection
