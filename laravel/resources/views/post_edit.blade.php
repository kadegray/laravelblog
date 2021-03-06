@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Post</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('post.update', ['post' => $post->id]) }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_method" value="put" />

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Header Image') }}</label>
                            <div class="col-md-6">
                                <img src="/post/{{ $post->id }}/image" width="100%"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $post->name }}" required autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                            <div class="col-md-6">
                                <textarea id="description" type="description" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ $post->description }}" required>{{ $post->description }}</textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="body" class="col-md-4 col-form-label text-md-right">{{ __('Body') }}</label>
                            <div class="col-md-6">
                                <textarea id="body" type="body" class="form-control @error('body') is-invalid @enderror" name="body" value="{{ $post->body }}" rows="10" required>{{ $post->body }}</textarea>

                                @error('body')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Change Header Image') }}</label>
                            <div class="col-md-6">
                                <input id="image" name="image" type="file" class="@error('image') is-invalid @enderror" class="form-control-file">

                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        @can('update', $post)
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                        @endif

                    </form>

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
@endsection
