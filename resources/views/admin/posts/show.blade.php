@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card mx-auto w-50">
            <img src="{{ $post->image }}" class="card-img-top" alt="{{ $post->title }}">
            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text">{{ $post->description }}</p>
                <a href="{{ URL::previous() }}" class="btn btn-primary">Back</a>
                <h4 class="card-title mb-0 mt-2">Tags:</h4>
                @forelse ($post->tags as $tag)
                    {{ $loop->last ? $tag->label : "$tag->label," }}
                @empty
                    Nessuna Categoria
                @endforelse
            </div>
        </div>
    </div>
@endsection
