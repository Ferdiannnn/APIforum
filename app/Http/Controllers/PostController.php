<?php

namespace App\Http\Controllers;


use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['reaction', 'comments'])->get();
        return response()->json($posts);
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
        return response()->json(['status' => true, 'data' => $post], 200);
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
            return response()->json(['status' => true, 'data' => $post], 200);
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
        $post = Post::with('reaction')->findOrFail($id);
        return response()->json($post);
    }
}