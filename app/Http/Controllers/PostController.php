<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\DemoMail;

class PostController extends Controller
{

    public function index()
    {
        if (request()->is('search')) {
            dd('hello');
            $posts = Posts::where('title', 'like', '%' . request('search') . '%')->get()
                ->orWhere('body', 'like', '%' . request('search') . '%');
        } else {
            $posts = Posts::all();
        }

        return view('admin.posts', [
            'posts' => $posts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.addposts');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        $attributes = request()->validate([
            'title' => 'required|min:3|unique:posts,title',
            'category_id' => 'required',
            'excerpt' => 'required|min:5',
            'body' => 'required|min:5',
            'image' => 'required',

        ]);
        //   dd(request()->file('image'));
        $attributes['user_id'] = auth()->id();
        $attributes['image'] = request()->file('image')->store('blog');

        $post = Posts::create($attributes);

        $mailData = [
            'title' => 'Mail form Web',
            'body' => 'hello , how are you this is for testing email',
            'id' => $post->id,
        ];
        // dd($attributes['id']);

        Mail::to('hemanshigajera2@gmail.com')->send(new DemoMail($mailData));
        // dd('email send ');
        session()->flash('success', 'New Post added.....');

        return redirect('/posts');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $post = Posts::find($id);
        return view('admin.editpost', [
            'post' => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id)
    {
        $attributes = request()->validate([
            'title' => 'required|min:3',
            'category_id' => 'required',
            'excerpt' => 'required|min:5',
            'body' => 'required|min:5',
        ]);
        $post = Posts::find($id);
        if (request()->file('image') != null) {
            $attributes['image'] = request()->file('image')->store('blog');
        }
        $post->update($attributes);
        session()->flash('success', 'Post updated successfully..');
        return redirect('/posts');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $delete = Posts::destroy($id);

        if ($delete == 1) {
            $success = true;
            $message = "Post Deleted....";
        } else {
            $success = true;
            $message = "Post Not found....";
        }

        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
    public function status(Posts $post)
    {
        $post->update([
            'status' =>
            request()->status
        ]);
        return response([
            'title' => 'success',
            'message' => 'Status Updated....',
        ]);
    }
}
