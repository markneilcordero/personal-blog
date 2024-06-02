<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\Tags;
use App\Models\PostTag;
use App\Models\Comments;
use App\Http\Requests\StorePostsRequest;
use App\Http\Requests\UpdatePostsRequest;
use App\Http\Requests\StoreTagsRequest;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('posts.index', [
            'posts' => Posts::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostsRequest $request, StoreTagsRequest $tagRequest)
    {
        $post = Posts::create([
            'user_id' => Auth::id(),
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        $tagIds = [];

        $tagNames = $tagRequest->input('tags');

        foreach ($tagNames as $tagName)
        {
            $tag = Tags::firstOrCreate(['name' => $tagName]);
            $tagIds[] = $tag->id;
        }

        foreach ($tagIds as $tagId)
        {
            PostTag::create([
                'post_id' => $post->id,
                'tag_id' => $tagId,
            ]);
        }
        
        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Posts $post)
    {
        $user = $post->user;

        return view('posts.show', [
            'user' => $user->name,
            'date' => $post->created_at,
            'title' => $post->title,
            'content' => $post->content,
            'post_id' => $post->id,
            'post_tags' => $post->tags,
            'comments' => Comments::where('post_id', $post->id)->with('user')->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Posts $post)
    {
        return view('posts.edit', [
            'post' => $post,
            'post_tags' => $post->tags,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostsRequest $request, StoreTagsRequest $tagRequest, Posts $post)
    {
        $post->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        $tagIds = [];

        $tagNames = $tagRequest->input('tags');

        if ($tagNames && is_array($tagNames) && count(array_filter($tagNames)) > 0) 
        {
            $tagIds = [];
            foreach ($tagNames as $tagName) 
            {
                if (!empty($tagName)) 
                {
                    $tag = Tags::firstOrCreate(['name' => $tagName]);
                    $tagIds[] = $tag->id;
                }
            }

            foreach ($tagIds as $tagId) 
            {
                PostTag::create([
                    'post_id' => $post->id,
                    'tag_id' => $tagId,
                ]);
            }
        }

        return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Posts $post)
    {
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully!');
    }
}
