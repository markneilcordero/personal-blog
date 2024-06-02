<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\Comments;
use App\Http\Requests\StoreCommentsRequest;
use App\Http\Requests\UpdateCommentsRequest;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreCommentsRequest $request, Posts $post)
    {
        Comments::create([
            'post_id' => $request->input('post_id'),
            'user_id' => Auth::id(),
            'content' => $request->input('content'),
        ]);

        return redirect()->route('posts.show', ['post' => $request->input('post_id')])->with('success', 'Comment created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comments $comments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comments $comments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentsRequest $request, Comments $comments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comments $comments)
    {
        //
    }
}
