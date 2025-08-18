@extends('layouts.app')
@section('title')
    Create
@endsection
@section('content')
    <form class="m-5" method="POST" action="{{ route('posts.store') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input name="title" type="text" class="form-control" value="{{ old('title') }}">
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Post Creator</label>
            <select name="post_creator" class="form-control">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" @if (isset($post) && $post->user_id == $user->id) selected @endif>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
            @error('post_creator')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button class="btn btn-success">Submit</button>
    </form>
@endsection
