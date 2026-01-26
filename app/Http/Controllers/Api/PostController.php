<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends BaseController
{
    public function index()
    {
        $posts = Post::with(['user:id,name,email', 'category:id,name,slug'])
            ->where('status', 'published')
            ->latest()
            ->get();

        return $this->sendResponse($posts, 'Posts retrieved successfully.');
    }

    public function adminIndex()
    {
        $posts = Post::with(['user:id,name,email', 'category:id,name,slug'])
            ->latest()
            ->get();

        return $this->sendResponse($posts, 'All posts for administration.');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'title'       => 'required|string|max:255',
            'body'        => 'required|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
            'status'      => 'nullable|in:draft,published'
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

    public function show(Post $post)
    {
        return $this->sendResponse($post->load(['user', 'category', 'comments']), 'Post details retrieved.');
    }

    public function update(Request $request, Post $post)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'sometimes|exists:categories,id',
            'title'       => 'sometimes|string|max:255',
            'body'        => 'sometimes|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
            'status'      => 'sometimes|in:draft,published'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($post->getRawOriginal('image')) {
                Storage::disk('public')->delete($post->getRawOriginal('image'));
            }
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($data);

        return $this->sendResponse($post, 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        if ($post->getRawOriginal('image')) {
            Storage::disk('public')->delete($post->getRawOriginal('image'));
        }

        $post->delete();

        return $this->sendResponse([], 'Post deleted successfully.');
    }
}
