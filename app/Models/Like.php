<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function posts()
    {
        return $this->belongsTo(Posts::class);
    }
    public function author()
    {
        return $this->belongsToMany(User::class, 'like_users','like_id','user_id');
    }
}
