@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (Auth::check())
                        <p style="font-size:1.5em;">Welcome back, {{ Auth::user()->name }}</p>
                    @endif
                        
                    <a href="{{ route('posts.create') }}" class="btn btn-success my-3">Add New Post</a>
                    <ul class="list-group list-group-flush">
                        @foreach ($posts as $post)
                            <li class="list-group-item">
                            <a href="{{ route('posts.show', ['post' => $post->id]) }}" style="font-size:1.4em;">{{ $post->title }}</a>
                                <div class="btn-group ms-3">
                                    <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn btn-primary rounded mx-1" role="button">Edit</a>
                                    <form action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" value="Delete" class="btn btn-danger mx-1">
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection