<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index()
    {
        $blogs = Post::all();
        return view('welcome', compact('blogs'));
    }
    public function blog($slug)
    {
        $post = Post::where('slug', $slug)->first();
        return view('blog', compact('post'));
    }
}
