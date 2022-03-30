@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card mx-auto w-50">
            <img src="{{ $post->image }}" class="card-img-top" alt="{{ $post->title }}">
            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text">{{ $post->description }}</p>
                <a href="{{ route('admin.posts.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
@endsection
