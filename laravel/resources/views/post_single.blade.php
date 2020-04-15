@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-body">
                <div class="card">
                    <div class="card-body">

                        <img class="card-img-top" src="/post/{{ $post->id }}/image">
                        <br><br>

                        <h5 class="card-title">{{ $post->name }}</h5>
                        <p class="card-text">{{ $post->body }}</p>

                        @can('update', $post)
                        <a class="btn btn-primary float-left" href="{{ route('post.edit', ['post' => $post->id]) }}">Edit</a>
                        @endif

                    </div>
                    <div class="card-footer text-muted">
                        Author: {{ $post->user->name }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
