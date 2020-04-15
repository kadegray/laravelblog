<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Throwable;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except([
            'index',
            'show'
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('user:id,name')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('post_list', [
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        if (!$user) {
            return response(null, 401);
        }

        if (!$user->can('create', Post::class)) {
            return response(null, 401);
        }

        return view('post_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response(null, 401);
        }

        if (!$user->can('create', Post::class)) {
            return response(null, 401);
        }

        $postData = $request->only([
            'name',
            'description',
            'body',
        ]);
        data_set($postData, 'user_id', (string) Auth::user()->id);

        $newPost = Post::create($postData);

        if ($request->hasFile('image')) {
            $imagePath = $request->image->store('public');
            data_set($newPost, 'header_image', $imagePath);
            $newPost->save();
        }

        return redirect(route('post.single', [
            'post' => $newPost->id
        ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        return view('post_single', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        if (!$post) {
            return response(null, 404);
        }

        $this->authorize('update', $post);

        return view('post_edit', [
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $post = Post::find($id);
        if (!$post) {
            return response(null, 404);
        }

        $this->authorize('update', $post);

        $putData = $request->only([
            'name',
            'description',
            'body',
        ]);

        $post->fill($putData);
        $post->save();

        if ($request->hasFile('image')) {
            $imagePath = $request->image->store('public');
            data_set($post, 'header_image', $imagePath);
            $post->save();
        }

        return redirect(route('post.single', [
            'post' => $id
        ]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $this->authorize('delete', $post);

        Storage::delete(storage_path('app/') . $post->header_image);
        Post::destroy($id);

        return redirect('post');
    }

    public function downloadHeaderImage($id)
    {
        $post = Post::find($id);

        return response()->download(storage_path('app/') . $post->header_image, 'header_image.jpeg');
    }
}
