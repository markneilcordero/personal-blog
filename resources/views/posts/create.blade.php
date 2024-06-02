@extends('layouts.app')

@push('scripts')
<script>
$(document).ready(function() {
    $('#addNewTag').on('click', function() {
        $('#tags').append('<input type="text" class="form-control mb-2" name="tags[]" placeholder="New Tag">');
    });
})
</script>
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add New Post') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('posts.store') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6 col-lg-12">
                                <label for="title" class="form-label">Title:</label>
                                <input type="text" name="title" class="form-control" placeholder="My Journey with Laravel">
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6 col-lg-12">
                                <label for="content" class="form-label">Content:</label>
                                <textarea name="content" class="form-control" rows="3" placeholder="This is my journey with learning Laravel..."></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 col-lg-12" id="tags">
                                <label for="tag" class="form-label">Tags:</label>
                                <button type="button" id="addNewTag" class="btn btn-info mb-3 ms-2">Add New Tag</button>
                                <input type="text" name="tags[]" class="form-control mb-2" placeholder="PHP">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <input type="submit" value="Publish" class="btn btn-success">
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection