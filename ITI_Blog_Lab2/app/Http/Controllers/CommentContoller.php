<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class CommentContoller extends Controller
{
    public function addComment($postId)
    {
        $post = Post::findOrFail($postId);

        request()->validate([
            'body' => 'required',
        ]);

        $post->comments()->create([
            'body' => request('body'),
        ]);

        return back();
    }
}
