<?php

namespace App\Http\Controllers;


use App\Http\Resources\PostDetailResource;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['reaction:id,user_id,post_id,type', 'comments:id,post_id,user_id,content', 'user:id,name'])->paginate(10);
        return PostResource::collection($posts);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);
        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => $request->user()->id
        ]);
        return new PostResource($post);
    }

    public function update(Request $request, $id)
    {
        $user = $request->user()->id;
        $post = Post::findOrFail($id);
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        if ($post->user_id == $user) {
            $post->update([
                'title' => $request->title,
                'content' => $request->content,
                'user_id' => $request->user()->id
            ]);
            return new PostResource($post);
        }
        return response()->json(['status' => false, 'message' => 'Unauthorized'], 403);
    }

    public function destroy(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        if ($post->user_id == $request->user()->id) {
            $post->delete();
            return response()->json(['status' => true, 'message' => 'Post deleted successfully'], 200);
        }
        return response()->json(['status' => false, 'message' => 'Unauthorized'], 403);
    }

    public function show($id)
    {
        $post = Post::with(['reaction', 'comments', 'user'])->findOrFail($id);
        return new PostDetailResource($post);
    }
}