<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class TrashController extends Controller
{
    public function trash()
    {
        $trashedPosts = Post::onlyTrashed()->with('user')->paginate(10);
        return view('posts.trash', compact('trashedPosts'));
    }

    public function restore($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        $post->restore();

        return redirect()->route('trash')->with('success', 'Post restored successfully');
    }

    public function forceDelete($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        $post->forceDelete();

        return redirect()->route('trash')->with('success', 'Post permanently deleted');
    }


}
