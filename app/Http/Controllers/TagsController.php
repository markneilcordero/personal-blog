<?php

namespace App\Http\Controllers;

use App\Models\Tags;
use App\Models\Posts;
use App\Models\PostTag;
use App\Http\Requests\StoreTagsRequest;
use App\Http\Requests\UpdateTagsRequest;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTagsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Tags $tag)
    {
        $posts = $tag->posts;

        return view('tags.show', [
            'title' => $tag->name,
            'post_tags' => $posts,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tags $tags)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTagsRequest $request, Tags $tags)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Posts $post, Tags $tag)
    {
        $post->tags()->detach($tag->id);
        return redirect()->back()->with('success', 'Tag deleted successfully!');
    }
}
