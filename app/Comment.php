<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user_id', 'post_id', 'content',
    ];

    // Every comment send to 1 post
    public function Post(){
        return $this->belongsTo(Post::class);
    }

    // Every comment has 1 writer
    public function User(){
        return $this->belongsTo(Post::class);
    }
}
