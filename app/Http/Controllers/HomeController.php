<?php

namespace App\Http\Controllers;
use App\Post;
use App\Category;

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
        
        return view('pages.create', compact('categories'));
    }

  

    public function store(Request $request) {

        $data = $request -> validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'release_date' => 'required|date',
            'description' => 'required|string|max:255'

        ]);

        // $post = Post::create($data);


        $category = Category::findOrFail($request -> get('category_id'));
        $post = Post::make($data);
        // dd($post, $category);
        $post -> category() -> associate($category);
        $post -> save();

        return redirect() -> route('posts', $post -> id);
    }
}
