<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog; 



class BlogModelController extends Controller
{
    // Retrieve all blogs
    public function index()
    {
        $blogs = Blog::all();
        return response()->json($blogs);
    }

    // Create a new blog
    public function store(Request $request)
    {
        $blog = Blog::create($request->all());
        return response()->json($blog, 201);
    }

    // Retrieve a specific blog
    public function show($id)
    {
        $blog = Blog::findOrFail($id);
        return response()->json($blog);
    }

    // Update a specific blog
    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);
        $blog->update($request->all());
        return response()->json($blog);
    }

    // Delete a specific blog
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();
        return response()->json(null, 204);
    }
}
