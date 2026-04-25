<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::paginate(10); // Menampilkan 10 postingan per halaman
        return PostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        //
        $validated = $request->validated();

        $validated['user_id'] = $request->user()->id;

        $post = Post::create($validated);

        return response()->json($post, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // CEGAH IDOR: Pastikan ID user yang login sama dengan pembuat postingan
        if ($request->user()->id !== $post->user_id) {
            return response()->json([
                'message' => 'Forbidden: Kamu tidak berhak mengedit postingan ini.'
            ], 403);
        }

        $validated = $request->validate([
            'title' => 'sometimes|max:100',
            'status' => 'sometimes|in:draft,published',
            'content' => 'sometimes',
        ]);

        $post->update($validated);

        return response()->json(new PostResource($post)); // Mengembalikan data yang sudah diupdate dalam format PostResource
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Post $post)
    {
        // CEGAH IDOR: Hanya pemilik yang boleh menghapus
        if ($request->user()->id !== $post->user_id) {
            return response()->json([
                'message' => 'Forbidden: Kamu tidak berhak menghapus postingan ini.'
            ], 403);
        }

        $post->delete();

        return response()->json([
            'id' => $post->id,
            'deleted' => true
        ]);
    }
}
