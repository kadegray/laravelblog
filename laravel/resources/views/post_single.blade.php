@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-body">
                <div class="card">
                    <div class="card-body">

                        <h5 class="card-title">{{ $post->name }}</h5>
                        <p class="card-text">User: {{ $post->user->name }}</p>
                        <p class="card-text">{{ $post->body }}</p>

                        @can('update', $post)
                        <a class="btn btn-primary float-left" href="{{ route('post.edit', ['post' => $post->id]) }}">Edit</a>
                        @endif

                        @can('delete', $post)
                        <form method="POST" action="{{ route('post.destroy', ['post' => $post->id]) }}">
                            @csrf
                            <input type="hidden" name="_method" value="delete" />
                            <button type="submit" class="btn btn-danger float-right">
                                {{ __('Delete') }}
                            </button>
                        </form>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
