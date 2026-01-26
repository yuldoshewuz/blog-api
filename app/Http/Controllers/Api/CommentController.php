<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CommentController extends Controller
{
    use AuthorizesRequests;

    public function index($postId)
    {
        $comments = Comment::where('post_id', $postId)
            ->with('user:id,name')
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data' => $comments
        ]);
    }

    public function store(Request $request, $postId)
    {
        $validator = Validator::make($request->all(), [
            'body' => 'required|string|min:2|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (!Post::where('id', $postId)->exists()) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        $comment = Comment::create([
            'user_id' => auth()->id(),
            'post_id' => $postId,
            'body' => $request->body,
        ]);

        return response()->json([
            'message' => 'Comment added successfully',
            'data' => $comment->load('user:id,name')
        ], 201);
    }

    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $validator = Validator::make($request->all(), [
            'body' => 'required|string|min:2|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $comment->update(['body' => $request->body]);

        return response()->json([
            'message' => 'Comment updated successfully',
            'data' => $comment
        ]);
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return response()->json(['message' => 'Comment deleted successfully']);
    }
}
