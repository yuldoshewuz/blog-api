<?php

namespace App\Http\Controllers\Api;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends BaseController
{
    public function toggle($post)
    {
        $post = Post::find($post);

        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => "Post not found!",
            ], 404);
        }

        $userId = auth()->id();
        $existingLike = Like::where('user_id', $userId)->where('post_id', $post->id)->first();

        if ($existingLike) {
            $existingLike->delete();
            return $this->sendResponse([
                'liked' => false,
                'likes_count' => $post->likes()->count()
            ], 'Like removed.');
        }

        Like::create(['user_id' => $userId, 'post_id' => $post->id]);

        return $this->sendResponse([
            'liked' => true,
            'likes_count' => $post->likes()->count()
        ], 'Post liked.', 201);
    }

    public function myLikedPosts(Request $request)
    {
        $perPage = $request->query('per_page', 10);

        $posts = Post::whereHas('likes', function ($q) {
            $q->where('user_id', auth()->id());
        })
            ->with(['user:id,name', 'category:id,name'])
            ->withCount('likes')
            ->latest()
            ->paginate($perPage);

        return $this->sendResponse($posts, 'Your favorite posts retrieved.');
    }
}
