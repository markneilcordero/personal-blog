@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="font-size:18px;">{{ $title }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>

                <div class="p-3">
                    <div class="row mb-3">
                        <div class="col-md-6 col-lg-12">
                            <p>Author: {{ $user }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6 col-lg-12">
                            <p>Date: {{ $date }}</p>
                        </div>
                    </div>
    
                    <div class="row mb-3">
                        <div class="col-md-6 col-lg-12">
                            <p>Content:</p>
                            <p class="px-3">{{ $content }}</p>
                        </div>
                    </div>
    
                    <div class="row mb-3">
                        <div class="col-md-6 col-lg-12">
                            <p>Tags:</p>
                            <ul class="list-group">
                                @foreach($post_tags as $tag)
                                    <li class="list-group-item"><a href="{{ route('tags.show', ['tag' => $tag->id]) }}">{{ $tag->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
    
                    <div class="row mb-3">
                        <div class="col-md-6 col-lg-12">
                            <p>Comments:</p>
                            <ul class="list-group">
                                @foreach($comments as $comment)
                                    <li class="list-group-item">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="badge text-bg-secondary">{{ $comment->user->name }}</span>
                                            <span class="text-secondary">{{ $comment->user->created_at }}</span>
                                        </div>
                                        <p class="mt-2 mb-0">{{ $comment->content }}</p>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6 col-lg-12">
                            <form action="{{ route('comments.store', [$post_id]) }}" method="POST">
                                @csrf
                                <input type="hidden" name="post_id" value="{{ $post_id }}">
                                <label for="comment" class="form-label">Add a Comment:</label>
                                <textarea name="content" class="form-control mb-3"></textarea>
                                <input type="submit" value="Submit" class="btn btn-success">
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection