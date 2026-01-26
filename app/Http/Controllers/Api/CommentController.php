<?php

namespace App\Http\Controllers\Api;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CommentController extends BaseController
{
    use AuthorizesRequests;

    public function index(Request $request, $postId)
    {
        $perPage = $request->query('per_page', 10);

        $comments = Comment::where('post_id', $postId)
            ->with('user:id,name')
            ->latest()
            ->paginate($perPage);

        return $this->sendResponse($comments, 'Comments retrieved successfully.');
    }

    public function store(Request $request, $postId)
    {
        $validator = Validator::make($request->all(), [
            'body' => 'required|string|min:2|max:1000',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        if (!Post::where('id', $postId)->exists()) {
            return $this->sendError('Post not found.', [], 404);
        }

        $comment = Comment::create([
            'user_id' => auth()->id(),
            'post_id' => $postId,
            'body' => $request->body,
        ]);

        return $this->sendResponse($comment->load('user:id,name'), 'Comment added successfully.', 201);
    }

    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $validator = Validator::make($request->all(), [
            'body' => 'required|string|min:2|max:1000',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $comment->update(['body' => $request->body]);

        return $this->sendResponse($comment, 'Comment updated successfully.');
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return $this->sendResponse([], 'Comment deleted successfully.');
    }
}
