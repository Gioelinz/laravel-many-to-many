@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="d-flex justify-content-end">
            <a href="{{ URL::previous() }}" class="btn btn-secondary">Indietro</a>
        </div>
        <h2>All Posts from <strong>{{ $tag->label }}</strong> tag</h2>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Category</th>
                    <th scope="col">Last update</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tag->posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>

                        <td>{{ $post->title }}</td>

                        <td>
                            <span
                                class="badge badge-pill badge-{{ $post->category->color ?? 'dark' }}">{!! $post->category->label ?? '<i class="fa-solid fa-ban"></i>' !!}
                            </span>
                        </td>
                        <td>{{ date('F j Y g:i a', strtotime($post->updated_at)) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">
                            <h1 class="text-center">Non ci sono Posts</h1>
                        </td>
                    </tr>
                @endforelse

            </tbody>
        @endsection
    </table>
</div>
