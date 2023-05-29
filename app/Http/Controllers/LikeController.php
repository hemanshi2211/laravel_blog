<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Posts;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store($id)
    {
        $post = Posts::find($id);

        $data = [
            'user_id' => auth()->user()->id,
            'posts_id' => $post->id,
            'status' => request()->status
        ];
        // dd($data);
        if(Like::where($data)->exists())
        {
            Like::where($data)->delete();
        }
        else
        {
            Like::create($data);
        }
    }
}
