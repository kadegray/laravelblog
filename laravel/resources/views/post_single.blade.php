@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->name }}</h5>
                        <p class="card-text">{{ $post->description }}</p>
                        <p class="card-text">{{ $post->body }}</p>
                        <a class="btn btn-primary" href="{{ route('post.edit', ['post' => $post->id]) }}">Edit</a>
                        <a class="btn btn-primary" href="{{ route('post.delete', ['post' => $post->id]) }}">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
