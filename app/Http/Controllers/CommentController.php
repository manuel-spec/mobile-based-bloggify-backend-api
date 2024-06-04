<?php 

use Illuminate\Http\Request;
use App\Models\Comment; // Assuming you have a Comment model

class CommentController extends Controller
{
  
    public function index()
    {
        $comments = Comment::all();
        return response()->json($comments);
    }

    public function store(Request $request)
    {
        $comment = new Comment;
        $comment->content = $request->input('content');
        $comment->save();
        return response()->json($comment);
    }

    public function show($id)
    {
        $comment = Comment::find($id);
        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }
        return response()->json($comment);
    }

    public function update(Request $request, $id)
    {
        $comment = Comment::find($id);
        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }
        $comment->content = $request->input('content');
        $comment->save();
        return response()->json($comment);
    }


    public function destroy($id)
    {
        $comment = Comment::find($id);
        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }
        $comment->delete();
        return response()->json(['message' => 'Comment deleted']);
    }
}
