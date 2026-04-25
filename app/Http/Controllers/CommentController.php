<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // GET /api/comments
    public function index()
    {
        $comments = Comment::all();
        return response()->json($comments);
    }

    // POST /api/comments
    public function store(Request $request)
    {
        $validated = $request->validate([
            'comment' => 'required|max:250',
            'post_id' => 'required|exists:posts,id',
            'user_id' => 'required|exists:users,id'
        ]);

        $comment = Comment::create($validated);
        return response()->json($comment, 201);
    }

    // GET /api/comments/{id}
    public function show(Comment $comment)
    {
        return response()->json($comment);
    }

    // PATCH/PUT /api/comments/{id}
    public function update(Request $request, Comment $comment)
    {
        $validated = $request->validate([
            'comment' => 'sometimes|required|max:250',
            'post_id' => 'sometimes|exists:posts,id',
            'user_id' => 'sometimes|exists:users,id'
        ]);

        $comment->update($validated);
        return response()->json($comment);
    }

    // DELETE /api/comments/{id}
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return response()->json([
            'id' => $comment->id,
            'deleted' => true
        ]);
    }
}