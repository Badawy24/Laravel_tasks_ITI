<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Jobs\NewPostsCount;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class PostController extends Controller
{
    public function index()
    {
        $postsFromDB = Post::with('user')->orderBy('created_at')->paginate(10);

        $newPostsCount = 0;
        $timestamps = Cache::get('new_posts', []);

        if (!empty($timestamps)) {
            $timestamps = array_filter($timestamps, fn($time) => Carbon::parse($time)->diffInSeconds(Carbon::now()) <= 60);
            $newPostsCount = count($timestamps);
        }

        return view('posts.index', ['posts' => $postsFromDB, 'newPostsCount' => $newPostsCount]);
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

    public function store(PostRequest $request)
    {
        $post = new Post;

        $post->title = $request->title;
        $post->description = $request->description;
        $post->user_id = $request->post_creator;

        $post->save();

        NewPostsCount::dispatch();

        return to_route('posts.index')->with('success', 'Post created successfully!');

    }

    public function edit($postId)
    {
        $users = User::all();
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
        return view('posts.edit', ['post' => $post, 'users' => $users]);
        // dd($post);
    }


    public function update(PostRequest $request, $postId)
    {
        $postFromDB = Post::findOrFail($postId);

        $postFromDB->update([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->post_creator,
        ]);


        return to_route('posts.show', $postId)->with('success', value: 'Post updated successfully!');
        ;
    }

    public function destroy($postId)
    {
        $postFromDB = Post::find($postId);
        $postFromDB->delete();

        return to_route('posts.index')->with('success', 'Post deleted successfully!');
    }

}
