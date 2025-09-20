<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $postId)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment = Comment::create([
            'post_id' => $postId,
            'user_id' => $request->user()->id,
            'content' => $request->content,
            'parent_id' => null
        ]);

        return new CommentResource($comment);
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

        $comment = Comment::create([
            'post_id' => $postId,
            'user_id' => $request->user()->id,
            'content' => $request->content,
            'parent_id' => $commentId,
        ]);

        return new CommentResource($comment);
    }

    public function update($postId, $commentId, Request $request)
    {
        $Comment = Comment::findOrFail($commentId);

        if ($request->user()->id == $Comment->user_id) {
            $Comment->update([
                'post_id' => $postId,
                'user_id' => $request->user()->id,
                'content' => $request->content
            ]);
            return new CommentResource($Comment);
        }
        return response()->json(["data" => "Not Found", "status" => 404]);
    }
}