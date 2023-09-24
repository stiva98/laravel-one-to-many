<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Controllers\Controller;

//Models
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $formData = $request->all();

        $post = new Post();
        $post->title = $formData['title'];
        $post->slug = $formData['slug'];
        $post->content = $formData['content'];
        $post->save();

        return redirect()->route('admin.posts.index');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $formData = $request->all();

        $post->title = $formData['title'];
        $post->slug = $formData['slug'];
        $post->content = $formData['content'];
        $post->save();

        return redirect()->route('admin.posts.show', ['post' => $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post -> delete();

        return redirect() ->route('admin.posts.index');
    }
}
