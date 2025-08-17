<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    public function index()
    {
        $postsFromDB = Post::with('user')->orderBy('created_at')->paginate(10);
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
        $users = User::all();

        return view('posts.create', compact('users'));
    }

    public function store()
    {
        // validation
        request()->validate([
            'title' => ['required', 'min:3'],
            'description' => ['required', 'min:5'],
            'post_creator' => ['required', 'exists:users,id']
        ]);


        $title = request()->title;
        $description = request()->description;
        $post_creator = request()->post_creator;

        $post = new Post;

        $post->title = $title;
        $post->description = $description;
        $post->user_id = $post_creator;

        $post->save();

        return to_route('posts.index');
    }

    public function edit($postId){
        $users = User::all();
        $posts = Post::all();
        $post = null;

        foreach ($posts as $element) {
            if ($element->id == $postId) {
                $post = $element;
                break;
            }
        }
        if($post == null){
        return to_route('posts.index');
        }
        return view('posts.edit',['post'=>$post,'users'=>$users]);
        // dd($post);
    }


    public function update($postId)
    {
        request()->validate([
            'title' => ['required', 'min:3'],
            'description' => ['required', 'min:5'],
            'post_creator' => ['required', 'exists:users,id']
        ]);


        $title = request()->title;
        $description = request()->description;
        $post_creator = request()->post_creator;

        $postFromDB = Post::find($postId);

        $postFromDB->update([
            'title' => $title,
            'description' => $description,
            'user_id' => $post_creator,
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
