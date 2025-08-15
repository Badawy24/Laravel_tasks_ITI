
@extends('layouts.app')
@section('title')
show
@endsection
@section('content')


    <div class="card mt-4">
        <div class="card-header">
            Post Info
        </div>
        <div class="card-body">
            <h5 class="card-title">Title: {{$post->title}}</h5>
            <h5 class="card-text">Description: </h5>
            <p>{{$post->description}}</p>
        </div>
    </div>
    <div class="card mt-4">
        <div class="card-header">
            Post Creator Info
        </div>
        <div class="card-body">
            <h5 class="card-title">Name: {{$post->creator}}</h5>
            <p class="card-text">Created At: {{$post->created_at->format('l jS \o\f F Y h:i:s a')}}</p>
        </div>
    </div>


@endsection
