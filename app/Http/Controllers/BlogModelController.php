<?php

namespace App\Http\Controllers;

use App\Models\BlogModel;
use Illuminate\Http\Request;

class BlogModelController extends Controller
{
    // Retrieve all blogs
    public function index()
    {
        return response([
            'blogs' => BlogModel::orderBy('created_at', 'desc')
                                ->with('user:id,name,username')
                                ->with('category:id,name') // Include category in the response
                                ->withCount('likes')
                                ->get(),
        ], 200);
    }

    // Create a new blog
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $blog = BlogModel::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'content' => $request->input('content'),
            'user_id' => auth()->id(),
            'category_id' => $request->input('category_id'),
        ]);

        return response()->json($blog, 201);
    }

    // Retrieve a specific blog
    public function show($id)
    {
        $blog = BlogModel::with(['user:id,name,username', 'category:id,name'])->findOrFail($id);

        return response()->json($blog);
    }

    // Update a specific blog
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $blog = BlogModel::findOrFail($id);
        $blog->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'content' => $request->input('content'),
            'category_id' => $request->input('category_id'),
        ]);

        return response()->json($blog);
    }

    // Delete a specific blog
    public function destroy($id)
    {
        $blog = BlogModel::findOrFail($id);
        $blog->delete();

        return response()->json(null, 204);
    }
}
