<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'content', 'image',
    ];

    // Every post has many comments
    public function Comment(){
        return $this->hasMany(Comment::class);
    }
}
