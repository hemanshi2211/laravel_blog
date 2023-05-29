<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store($id)
    {
        $post = Posts::find($id);
        request()->validate([
            'body' => 'required|min:5'
        ]);

        $post->comments()->create([
            'user_id' => auth()->user()->id,
            'body' => request('body')
        ]);
        return back();
    }
}
