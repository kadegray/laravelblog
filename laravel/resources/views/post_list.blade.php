@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-body">
                @foreach ($posts as $post)
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->name }}</h5>
                            <p class="card-text">{{ $post->user->name }}</p>
                            <p class="card-text">{{ $post->description }}</p>
                            <a class="btn btn-primary" href="{{ route('post.single', ['post' => $post->id]) }}">Read</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
