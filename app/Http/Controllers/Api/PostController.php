<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Str;

class PostController extends BaseController
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $perPage = $request->query('per_page', 10);
        $search = $request->query('search');

        $posts = Post::with(['user:id,name', 'category:id,name'])
            ->withCount('likes')
            ->where('status', 'published')
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('body', 'like', "%{$search}%");
                });
            })
            ->when($request->category_id, function ($query, $catId) {
                $query->where('category_id', $catId);
            })
            ->latest()
            ->paginate($perPage);

        return $this->sendResponse($posts, 'Posts retrieved successfully.');
    }

    public function adminIndex(Request $request)
    {
        $perPage = $request->query('per_page', 10);
        $search = $request->query('search');

        $posts = Post::with(['user:id,name', 'category:id,name'])
            ->withCount('likes')
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('body', 'like', "%{$search}%");
                });
            })
            ->when($request->category_id, function ($query, $catId) {
                $query->where('category_id', $catId);
            })
            ->latest()
            ->paginate($perPage);

        return $this->sendResponse($posts, 'All posts for administration.');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
            'status' => 'nullable|in:draft,published'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $data = $request->all();
        $data['user_id'] = auth()->id();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        $post = Post::create($data);

        return $this->sendResponse($post, 'Post created successfully.', 201);
    }

    public function show($post)
    {
        $post = Post::find($post);

        if (!$post) {
            return response()->json([
                'status' => "error",
                'message' => "Post not found!",
            ], 404);
        }

        $post->increment('views_count');

        return $this->sendResponse($post->load(['user', 'category', 'comments']), 'Post details retrieved.');
    }

    public function update(Request $request, $post)
    {
        $post = Post::find($post);

        if (!$post) {
            return response()->json([
                'status' => "error",
                'message' => "Post not found!",
            ], 404);
        }

        $this->authorize('update', $post);

        $validator = Validator::make($request->all(), [
            'category_id' => 'sometimes|exists:categories,id',
            'title' => 'sometimes|string|max:255',
            'body' => 'sometimes|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
            'status' => 'sometimes|in:draft,published'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $data = $request->all();

        if ($request->has('title')) {
            $data['slug'] = Str::slug($request->title);
        }

        if ($request->hasFile('image')) {
            if ($post->getRawOriginal('image')) {
                Storage::disk('public')->delete($post->getRawOriginal('image'));
            }
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($data);

        return $this->sendResponse($post, 'Post updated successfully.');
    }

    public function destroy($post)
    {
        $post = Post::find($post);

        if (!$post) {
            return response()->json([
                'status' => "error",
                'message' => "Post not found!",
            ], 404);
        }

        $this->authorize('delete', $post);

        if ($post->getRawOriginal('image')) {
            Storage::disk('public')->delete($post->getRawOriginal('image'));
        }

        $post->delete();

        return $this->sendResponse([], 'Post deleted successfully.');
    }
}
