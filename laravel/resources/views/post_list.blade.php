@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach ($posts as $post)
                <div class="card">
                    <img class="card-img-top" src="/post/{{ $post->id }}/image">
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->name }}</h5>
                        <p class="card-text">{{ $post->description }}</p>
                        <a class="btn btn-primary" href="{{ route('post.single', ['post' => $post->id]) }}">Read</a>
                    </div>
                    <div class="card-footer text-muted">
                        Author: {{ $post->user->name }}
                    </div>
                </div>
                <br>
            @endforeach
        </div>
    </div>
</div>
@endsection
