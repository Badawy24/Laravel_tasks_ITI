<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $postsFromDB = Post::all();


        return view('posts.index', ['posts' => $postsFromDB]);
    }

    public function show($postId)
    {
        $postFromDB = Post::find($postId);

        if (is_null($postFromDB)) {

            return to_route('posts.index');
        }
        return view('posts.show', ['post' => $postFromDB]);
    }



    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        // validation
        request()->validate([
            'title' => ['required', 'min:3'],
            'description' => ['required', 'min:5'],
        ]);


        $data = request()->all();
        $title = request()->title;
        $description = request()->description;
        $post_creator = request()->post_creator;

        $post = new Post;

        $post->title = $title;
        $post->description = $description;
        $post->creator = $post_creator;

        $post->save();

        return to_route('posts.index');
    }

    public function edit($postId)
    {
        $posts = Post::all();
        $post = null;

        foreach ($posts as $element) {
            if ($element->id == $postId) {
                $post = $element;
                break;
            }
        }
        if ($post == null) {
            return to_route('posts.index');
        }
        return view('posts.edit', ['post' => $post]);
    }


    public function update($postId)
    {
        request()->validate([
            'title' => ['required', 'min:3'],
            'description' => ['required', 'min:5'],
        ]);

        $data = request()->all();

        $title = request()->title;
        $description = request()->description;
        $post_creator = request()->post_creator;

        $postFromDB = Post::find($postId);

        $postFromDB->update([
            'title' => $title,
            'description' => $description,
            'creator' => $post_creator,
        ]);


        return to_route('posts.show', $postId);
    }

    public function destroy($postId)
    {
        $postFromDB = Post::find($postId);
        $postFromDB->delete();

        return to_route('posts.index');
    }
}
