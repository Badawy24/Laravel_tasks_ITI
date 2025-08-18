<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;

class CommentContoller extends Controller
{
    public function addComment(CommentRequest $request, $postId)
    {
        $post = Post::findOrFail($postId);

        $post->comments()->create([
            'body' => $request->body,
        ]);

        return back();
    }
}
