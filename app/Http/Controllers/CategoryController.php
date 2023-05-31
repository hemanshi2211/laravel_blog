<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{


    public function index()
    {
        $categories = Category::all();
        return view('admin.category', [
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        //
    }

    public function store()
    {

        $attributes = request()->validate([
            'name' => 'required|min:3|unique:categories,name',
            'status' => 'required',
        ]);

        Category::create($attributes);
        session()->flash('success','Category added..');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Category $category)
    {
        return $category;
    }

    public function update(Category $category)
    {
        $attributes = request()->validate([
            'name' => 'required|min:3',
            'status' => 'required',
        ]);

        $category->update($attributes);
        session()->flash('success','Category Updated...');
    }

    public function destroy($id)
    {
        $delete = Category::destroy($id);
        if ($delete == 1) {
            $success = true;
            $message = "Category deleted successfully";
        } else {
            $success = true;
            $message = "Category not found";
        }
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
}
