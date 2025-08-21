@extends('layouts.app')
@section('title')
    Edit
@endsection
@section('content')
    <form class="m-5" method="POST" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" name="image" class="form-control" onchange="previewImage(event)">
            @error('image')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            @if ($post->image)
                <p>Current Image:</p>
                <img src="{{ $post->image_url }}" width="200">
            @endif

            <img id="preview" src="#" class="mt-2" style="max-width: 200px; display:none;">
        </div>
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input name="title" type="text" class="form-control" value={{ $post->title }}>
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3"> {{ $post->description }}</textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Post Creator: {{ $post->user->name }}</label>
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
        <button class="btn btn-primary">Update</button>
    </form>
    <script>
        function previewImage(event) {
            const preview = document.getElementById('preview');
            preview.src = URL.createObjectURL(event.target.files[0]);
            preview.style.display = 'block';
        }
    </script>
@endsection
