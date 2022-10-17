<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostCollection;
use App\Http\Requests\StorePostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        // $posts = Post::with('user_id')->latest()->get();

        // return $posts->toJson(JSON_PRETTY_PRINT);
        // return Post::all();

        // return new PostCollection(Post::all());
        return new PostCollection(Post::orderByDesc('created_at')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        // $imageName = $request->image->store('posts');

        // $arrayStore = $request->all();
        // $request->safe()->merge($arrayStore);

        // foreach($validated as $validate){ }


        if (Post::create($request->all())) {
            return response()->json([
                'succes' => 'Post crée'
            ], 200);
        } else {
            return response();
        }


        //------------------------- Note ---------------------
        // redirect()->route('profile', ['id' => 1]);

        // return response($content)
        //     ->header('Content-Type', $type)
        //     ->header('X-Header-One', 'Header Value')
        //     ->header('X-Header-Two', 'Header Value');
        //---------------------------------------------------

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return $post;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(StorePostRequest $request, Post $post)
    {
        if ($post->update($request->all())) {
            return response()->json([
                'succes' => 'Post modifier'
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if ($post->delete()) {
            return response()->json([
                'succes' => 'Post supprimé'
            ], 200);
        }
    }
}
