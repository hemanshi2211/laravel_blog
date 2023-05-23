<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Posts::all();

        return view('admin.posts',[
            'posts' => $posts,
        ]);
    }

    public function create()
    {
        return view('admin.addposts');
    }

    public function store()
    {
        // dd('hello');
     $attributes = request()->validate([
            'title' => 'required|min:3|unique:posts,title',
            'category_id' => 'required',
            'excerpt' => 'required|min:5',
            'body' => 'required|min:5',
            'image' => 'required',
        ]);
//   dd(request()->file('image'));
        $attributes['image'] = request()->file('image')->store('blog');

        Posts::create($attributes);

        session()->flash('success','New Post added.....');

        return redirect('/posts');
    }

    public function edit($id)
    {
        $post = Posts::find($id);
        return view('admin.editpost',[
            'post' => $post,
        ]);
    }

    // public function update()
    // {

    // }


    public function delete($id)
    {
        $delete = Posts::destroy($id);

        if($delete == 1)
        {
            $success = true;
            $message = "Post Deleted....";
        }
        else
        {
            $success = true;
            $message = "Post Not found....";
        }

        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
}
