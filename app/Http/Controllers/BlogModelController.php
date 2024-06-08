<?php
namespace App\Http\Controllers;

use App\Models\BlogModel;
use Illuminate\Http\Request;

class BlogModelController extends Controller
{
    public function index()
    {
        $blogs = BlogModel::orderByDesc('created_at')
            ->with('user:id,name,username')
            ->with('category:id,name')
            ->withCount('likes')
            ->get();

        return response()->json(['blogs' => $blogs], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $blog = BlogModel::create($request->only('title', 'description', 'content', 'category_id') + ['user_id' => auth()->id()]);

        return response()->json($blog, 201);
    }

    public function show($id)
    {
        $blog = BlogModel::with(['user:id,name,username', 'category:id,name'])->findOrFail($id);

        return response()->json($blog);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $blog = BlogModel::findOrFail($id);
        $blog->update($request->only('title', 'description', 'content', 'category_id'));

        return response()->json($blog);
    }

    public function destroy($id)
    {
        $blog = BlogModel::findOrFail($id);
        $blog->delete();

        return response()->json(null, 204);
    }

    public function myBlogs($id)
    {
        $blogs = BlogModel::where('user_id', $id)
            ->with('user:id,name,username')
            ->with('category:id,name')
            ->withCount('likes')
            ->get();

        return response()->json($blogs);
    }
}
