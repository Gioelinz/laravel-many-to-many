<!DOCTYPE html>
<html lang="en">

<head>
    <title>Post Creation</title>
</head>

<body>
    <h1>Il post <em>{{ $post->title }}</em> è stato creato con successo</h1>

    <h4>{{ $post->created_at }}</h4>
    <h4>Categoria:</h4>
    <h5>
        {{ $post->category->label }}

    </h5>
    <h4>Tags:</h4>
    @forelse ($post->tags as $tag)
        <span>{{ $tag->label }} </span>
    @empty
        -
    @endforelse
</body>

</html>
