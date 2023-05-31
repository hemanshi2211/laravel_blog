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
        ];
        // dd($data);
        if(Like::where($data)->exists())
        {
            // dd('hello');
            // dd(Like::where($data)->where('status',0)->exists());
            $like = Like::Where($data)->get();
            if($like->first()->status == request()->status)
            {
                Like::where($data)->delete();
            }
            else
            {
                Like::Where($data)->update(['status' => request()->status]);
            }
        }
        else
        {
            $data['status'] = request()->status;
            $like = Like::create($data);
            auth()->user()->likes()->attach($like);
        }

        $like = Like::Where('status',1)->Where('posts_id',$post->id)->count();
        $dislike = Like::Where('status',0)->Where('posts_id',$post->id)->count();
        return compact(['like','dislike']);

    }
}
