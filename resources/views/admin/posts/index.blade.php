@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <div class="d-flex justify-content-end">
            <a href="{{ route('admin.posts.create') }}" class="btn btn-lg btn-success mb-2"><i
                    class="fa-solid fa-plus mr-2"></i>Crea Post</a>
        </div>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Category</th>
                    <th scope="col">Tags</th>
                    <th scope="col">Last update</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($posts as $post)
                    <tr>
                        <th scope="row">{{ $post->id }}</th>
                        <td>
                            <a href="{{ route('admin.posts.show', $post) }}">{{ $post->title }}</a>
                        </td>
                        <td>
                            <h5>
                                <span
                                    class="badge badge-pill badge-{{ $post->category->color ?? 'dark' }}">{!! $post->category->label ?? '<i class="fa-solid fa-ban"></i>' !!}
                                </span>
                            </h5>
                        </td>
                        <td>
                            @forelse ($post->tags as $tag)
                                <h5 class="d-inline-block">
                                    <a href="{{ route('admin.tags.show', $tag) }}" class="badge badge-light"
                                        style="background-color: {{ $tag->color ?? '#000000' }}">{{ $tag->label }}
                                    </a>
                                </h5>
                            @empty
                                <h5>
                                    <span class="badge badge-pill badge-dark">
                                        <i class="fa-solid fa-ban"></i>
                                    </span>
                                </h5>
                            @endforelse
                        </td>
                        <td>{{ date('F j Y g:i a', strtotime($post->updated_at)) }}</td>
                        <td class=" d-flex">
                            <a class="btn btn-warning mr-2" href="{{ route('admin.posts.edit', $post) }}"><i
                                    class="fa-solid fa-pencil"></i></a>

                            @include('includes.modal-confirm')
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="4">
                            <h1 class="text-center">Non ci sono Posts</h1>
                        </td>
                    </tr>
                @endforelse

            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $posts->links() }}
        </div>
        <div class="mb-2">
            <span class="h3">Tags</span>
            <span><i class="fa-solid fa-arrow-turn-down fa-lg"></i></span>
        </div>
        @forelse ($tags as $tag)
            <a href="{{ route('admin.tags.show', $tag) }}"
                class="btn btn-dark mb-4 {{ !count($tag->posts) ? 'disabled' : '' }}">
                {{ $tag->label }} <span class="badge badge-light">{{ count($tag->posts) }}</span>
            </a>
        @empty
        @endforelse
    </div>
@endsection
