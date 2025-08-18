@extends('layouts.app')
@section('title')
    Trash Bin
@endsection
@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show w-25 text-center mx-auto mt-2" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="text-center">
        <h2 class="mt-3 mb-4">Trash Bin</h2>

        <table class="table mt-4">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Posted By</th>
                    <th scope="col">Deleted At</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($trashedPosts as $post)
                    <tr>
                        <th scope="row">{{ $post->id }}</th>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->user->name ?? 'Unknown' }}</td>
                        {{-- <td>{{ $post->deleted_at->format('Y-m-d H:i') }}</td> --}}
                        <td>{{ $post->deleted_at }}</td>
                        <td>
                            <form class="d-inline" method="POST" action="{{ route('trash.restore', $post->id) }}">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Restore</button>
                            </form>

                            <form class="d-inline" method="POST" action="{{ route('trash.forceDelete', $post->id) }}"
                                onsubmit="return confirm('This will permanently delete the post. Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete Permanently</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">No deleted posts found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Bootstrap Pagination --}}
        {{ $trashedPosts->links('pagination::bootstrap-5') }}
    </div>
@endsection
