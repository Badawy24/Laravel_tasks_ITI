@extends('layouts.app')
@section('title')
Edit
@endsection
@section('content')

<form class="m-5" method="POST" action="{{route('posts.update',$post->id)}}">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label class="form-label">Title</label>
        <input name="title" type="text" class="form-control" value="{{$post->title}}">
    </div>
    <div class="mb-3">
        <label  class="form-label">Description</label>
        <textarea name="description" class="form-control"  rows="3"> {{$post->description}}</textarea>
    </div>
    <div class="mb-3">
        <label  class="form-label">Post Creator: {{$post->creator}}</label>
        <select name="post_creator" class="form-control">
            <option selected value="{{$post->creator}}">{{$post->creator}}</option>
       <option value="Ahmed">Ahmed</option>
            <option value="Ali">Ali</option>
            <option value="Badawy">Badawy</option>
            <option value="Abdelrahman">Abdelrahman</option>
        </select>
    </div>
    <button class="btn btn-primary">Update</button>
</form>

@endsection
