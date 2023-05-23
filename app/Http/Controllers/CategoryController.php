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

    public function store()
    {
        // dd(request());
        $attributes = request()->validate([
            'name' => 'required|min:3|unique:categories,name',
            'status' => 'required',
        ]);

        Category::create($attributes);
        session()->flash('success','Category added..');

        // return response();
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

    public function delete($id)
    {
        $delete = Category::destroy($id);

        // check data deleted or not
        if ($delete == 1) {
            $success = true;
            $message = "Category deleted successfully";
        } else {
            $success = true;
            $message = "Category not found";
        }

        //  return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
}
