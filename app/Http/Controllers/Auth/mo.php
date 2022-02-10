<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function posts() {

        $posts = Post::orderBy('created_at', 'desc') ->get();

        return view('pages.posts', compact('posts'));
    }

    public function create() {

        $categories = Category::all();
        $tags = Tag::all();

        return view('pages.create', compact('categories', 'tags'));
    }
    public function store(Request $request) {

        $data = $request -> validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'release_date' => 'required|date',

        ]);

        $data['author'] = Auth::user() -> name;

        $post = Post::make($data);

        $category = Category::findOrFail($request -> get('category'));
        $post ->category() -> associate($category);
        $post ->save();

        if ($request -> has('tags')) {
            $tags = Tag::findOrFail($request -> get('tags'));
        }
        $post ->tags() -> attach($tags);
        $post ->save();

        return redirect() -> route('posts');
    }

    public function edit($id) {

        $categories = Category::all();
        $tags = Tag::all();

        $post = Post::findOrFail($id);

        return view('pages.edit', compact('post', 'categories', 'tags'));
    }
    public function update(Request $request, $id) {
        
        $data = $request -> validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'release_date' => 'required|date',

        ]);

        $data['author'] = Auth::user() -> name;

        $post = Post::findOrFail($id);
        $post -> update($data);

        $category = Category::findOrFail($request -> get('category'));
        $post ->category() -> associate($category);
        $post ->save();

        if ($request -> has('tags')) {
            $tags = Tag::findOrFail($request -> get('tags'));
        }
        $post ->tags() -> sync($tags);
        $post ->save();

        return redirect() -> route('posts');
    }

    public function delete($id) {

        $post = Post::findOrFail($id);

        $post -> tags() -> sync([]);
        $post -> save();

        $post -> delete();

        return redirect() -> route('posts');
    }
}