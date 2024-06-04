<?php

namespace App\Http\Controllers;

use App\Models\BlogModel;
use App\Models\Like;

class LikeController extends Controller
{
    public function toggleLike($id)
    {
        $blog = BlogModel::find($id);

        if (! $blog) {
            return response([
                'message' => 'Blog not found.',
            ], 404);
        }

        $like = $blog->likes()->where('user_id', auth()->user()->id)->first() ;

        if (! $like) {
            Like::create([
                'blog_id' => $id,
                'user_id' => auth()->user()->id,
            ]);

            return response([
                'message' => 'Liked.',
            ], 200);
        }

        $like->delete();

        return response([
            'message' => 'Disliked.',
        ], 200);
    }
}
