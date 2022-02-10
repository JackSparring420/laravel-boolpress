<?php

namespace App\Http\Controllers;
use App\Post;
use App\Tag;
use App\Category;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('pages.home');
    }

    public function posts() {

        $posts = Post::all();


        return view('pages.posts', compact('posts'));
    }

    public function create() {

        $categories = Category::all();
        $tags = Tag::all();
        
        return view('pages.create', compact('categories', 'tags'));
    }

    public function tags() {

        $tags = Tag::all();
        
        return view('pages.create', compact('tags'));
    }

  

    public function store(Request $request) {

        $data = $request -> validate([
            'title' => 'required|string|max:255',
            'release_date' => 'required|date',
            'description' => 'required|string|max:255'

        ]);

        $user = Auth::user();
        $data['author'] = $user -> name;

        $category = Category::findOrFail($request -> get('category_id'));
        $post = Post::make($data);
        // dd($post, $category);
        $post -> category() -> associate($category);
        $post -> save();

        $tags = Tag::findOrFail($request -> get('tags'));
        // dd($tags);
        $post -> tags() -> attach($tags);
        $post -> save();
        return redirect() -> route('posts', $post -> id);
    }

    public function edit($id)
        {
            $categories = Category::all();
            $tags = Tag::all();
            $post = Post::findOrFail($id);


            return view('pages.edit', compact('categories', 'tags', 'post'));
        }

    public function update(Request $request, $id) {

        $data = $request -> validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'release_date' => 'required|date',

        ]);

        $user = Auth::user();
        $data['author'] = $user -> name;

        $post = Post::findOrFail($id);
        $post -> update($data);

        $category = Category::findOrFail($request -> get('category_id'));
        $post ->category() -> associate($category);
        $post ->save();

        if ($request -> has('tags')) {
            $tags = Tag::findOrFail($request -> get('tags'));
        }
        $post -> tags() -> sync($tags);
        $post -> save();
        
        // dd($post);
    
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
