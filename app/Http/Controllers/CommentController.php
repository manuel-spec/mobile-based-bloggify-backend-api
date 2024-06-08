<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\BlogModel;

class CommentController extends Controller
{
  
    public function index($blogId)
    {
        $comments = Comment::where('blog_id', $blogId)->get();
        return response()->json($comments);
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:255',
            'blog_id' => 'required|exists:blog_models,id',
        ]);
        $blogId = $request->input('blog_id');

        $blog = BlogModel::find($blogId);
        if (!$blog) {
            return response()->json(['message' => 'Blog not found'], 404);
        }

        $comment = new Comment;
        $comment->content = $request->input('content');
        $comment->blog_id = $blogId;
        $comment->user_id = auth()->id(); 
        $comment->save();

        return response()->json($comment, 201);
    }

    public function show($blogId, $id)
    {
        $comment = Comment::where('blog_id', $blogId)->find($id);
        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }

        return response()->json($comment);
    }

    public function update(Request $request, $blogId, $id)
    {
        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $comment = Comment::where('blog_id', $blogId)->find($id);
        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }

        $comment->content = $request->input('content');
        $comment->save();

        return response()->json($comment);
    }

    public function destroy($blogId, $id)
    {
        $comment = Comment::where('blog_id', $blogId)->find($id);
        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }

        $comment->delete();

        return response()->json(['message' => 'Comment deleted']);
    }
    public function myComments(Request $request)
    {
        $id = auth()->id();
        $blog_id = $request->input('blog_id');
        $blog_comments = Comment::where('blog_id', $blog_id)->get();
        $comments = Comment::where('user_id', $id)->get();

        return response()->json($blog_comments);
    }
}
