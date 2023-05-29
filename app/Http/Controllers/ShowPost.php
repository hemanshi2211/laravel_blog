<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Http\Request;

class ShowPost extends Controller
{
    public function index()
    {
        return view('welcome',[
            'posts' => Posts::all()
        ]);
    }
    public function show($id)
    {
        $post = Posts::find($id);
        return view('postdetail',[
            'post' => $post
        ]);
    }

    public function catShow($id)
    {
        $category = Category::find($id);
        return view('welcome',[
            'posts' => $category->posts
        ]);
    }

    public function authorShow($id)
    {
        $author = User::find($id);
        return view('welcome',[
            'posts' => $author->posts
        ]);
    }
}
