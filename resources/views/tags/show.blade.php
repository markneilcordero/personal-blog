@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $title }}</div>
                    <ul class="list-group">
                        @foreach($post_tags as $post)
                            <li class="list-group-item">{{ $post->title }}&nbsp;<a href="{{ route('posts.show', ['post' => $post->id]) }}" class="btn btn-primary">Read More</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection