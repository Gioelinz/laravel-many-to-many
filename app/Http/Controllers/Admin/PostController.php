<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('updated_at', 'desc')->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new Post();
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.create', compact('post', 'categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate(
            [
                'title' => 'required|string|unique:posts|min:5|max:255',
                'image' => 'required|url|unique:posts',
                'description' => 'required|string',
                'category_id' => 'nullable|exists:categories,id',
                'tags' => 'nullable|exists:tags,id'
            ],
            [
                'required' => 'Il campo :attribute è obbligatorio!',
                'title.unique' => "Il Post $request->title è già esistente!",
                'image.unique' => "Questa immagine è già stata inserita!",
                'title.min' => "$request->title è lungo meno di 5 caratteri!",
                'image.url' => "Inserisci un url valido!",
            ]
        );

        $data = $request->all();

        $data['slug'] = Str::slug($request->title, '-');

        $post = Post::create($data);

        if (array_key_exists('tags', $data)) $post->tags()->attach($data['tags']);

        return redirect()->route('admin.posts.index')->with('message', "$post->title creato con successo");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();

        $current_tags = $post->tags()->pluck('id')->toArray();

        return view('admin.posts.edit', compact('post', 'categories', 'tags', 'current_tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate(
            [
                'title' => ['required', 'string', Rule::unique('posts')->ignore($post->id), 'min:5', 'max:255'],
                'image' => ['required', 'url', Rule::unique('posts')->ignore($post->id)],
                'description' => 'required|string|min:5',
                'category_id' => 'nullable|exists:categories,id',
                'tags' => 'nullable|exists:tags,id'
            ],
            [
                'required' => 'Il campo :attribute è obbligatorio!',
                'title.unique' => "Il Post $request->title è già esistente!",
                'image.unique' => "Questa immagine è già stata inserita!",
                'image.url' => "Inserisci un url valido!",
                'title.min' => "$request->title è lungo meno di 5 caratteri!"
            ]
        );

        $data = $request->all();

        $data['slug'] = Str::slug($request->title, '-');

        $post->update($data);

        if (array_key_exists('tags', $data)) $post->tags()->sync($data['tags']);
        else $post->tags()->detach();

        return redirect()->route('admin.posts.index')->with('message', "$post->title modificato con successo");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index')->with('message', "Il Post $post->title è stato cancellato");
    }
}
