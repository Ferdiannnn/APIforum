<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $postId)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment = new Comment();
        $comment->post_id = $postId;
        $comment->user_id = $request->user()->id;
        $comment->content = $request->input('content');
        $comment->save();

        return response()->json($comment, 201);
    }

    public function destroy(Request $request, $postId, $commentId)
    {
        $comment = Comment::findOrFail($commentId);
        if ($comment->user_id == $request->user()->id) {
            $comment->delete();
            return response()->json(['status' => true, 'message' => 'Comment deleted successfully'], 200);
        }
        return response()->json(['status' => false, 'message' => 'Unauthorized'], 403);
    }

    public function reply(Request $request, $postId, $commentId)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment = new Comment();
        $comment->post_id = $postId;
        $comment->user_id = $request->user()->id;
        $comment->content = $request->input('content');
        $comment->parent_id = $commentId; // Set parent_id
        $comment->save();

        return response()->json($comment, 201);
    }
}