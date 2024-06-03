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
            'blogs' => BlogModel::orderBy('created_at', 'desc')->with('user:id,name,username')->withCount('likes')->get(),
        ], 200);
    }

    // Create a new blog
    public function store(Request $request)
    {
        $blog = BlogModel::create($request->all());

        return response()->json($blog, 201);
    }

    // Retrieve a specific blog
    public function show($id)
    {
        $blog = BlogModel::findOrFail($id);

        return response()->json($blog);
    }

    // Update a specific blog
    public function update(Request $request, $id)
    {
        $blog = BlogModel::findOrFail($id);
        $blog->update($request->all());

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
