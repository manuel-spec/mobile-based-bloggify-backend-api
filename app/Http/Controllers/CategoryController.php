<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    // Constructor to require authentication for all methods except index and show
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    // List all categories
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    // Store a new category
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = new Category;
        $category->name = $request->input('name');
        $category->save();

        return response()->json($category, 201);
    }

    // Show a specific category
    public function show($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        return response()->json($category);
    }

    // Update a specific category
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',

        ]);

        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $category->name = $request->input('name');
        $category->save();

        return response()->json($category);
    }

    // Delete a specific category
    public function destroy($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $category->delete();

        return response()->json(['message' => 'Category deleted']);
    }
}
