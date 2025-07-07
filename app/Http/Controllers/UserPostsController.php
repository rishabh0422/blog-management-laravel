<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use Illuminate\Support\Str;
use App\Models\Category;
use Illuminate\Http\Request;

class UserPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->category_id) {
            $categories = Category::all();
            $posts = Post::with('category')
                ->where('user_id', auth()->id())
                ->when($request->category_id, function ($query) use ($request) {
                    $query->where('category_id', $request->category_id);
                })
                ->latest('created_at')
                ->paginate(5);
            return view('user.posts', compact('posts', 'categories'));
        }
        $categories = Category::all();
        $posts = auth()->user()->posts()->with('category')->latest('created_at')->paginate(6);
        return view('user.posts', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'body' => 'nullable',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);


        $post = new Post();

        if ($request->hasFile('img')) {
            $img_path = $request->file('img')->store('', 'public');
            $post->img = $img_path;
        } else {

            $post->img = "https://images.pexels.com/photos/262508/pexels-photo-262508.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500";
        }
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->body = $request->body;
        $post->category_id = $request->category_id;
        $post->user_id = auth()->id();
        $post->save();
        return redirect('/user/posts');

    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $post = Post::with(['category', 'user'])
            ->where('slug', $slug)
            ->firstOrFail();
        return view('user.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::all();
        $post = DB::table('posts as p')
            ->join('categories as c', 'p.category_id', '=', 'c.id')
            ->select('p.*', 'c.name as category_name')
            ->where('p.id', $id)
            ->first();
        return view('posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'body' => 'nullable',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $post = Post::findOrFail($id);
        if ($request->hasFile('img')) {
            $img_path = $request->file('img')->store('', 'public');
            $post->img = $img_path;
        } else {

            $post->img = "https://images.pexels.com/photos/262508/pexels-photo-262508.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500";
        }

        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->body = $request->body;
        $post->category_id = $request->category_id;
        $post->user_id = auth()->id();

        // If a new image is uploaded
        if ($request->hasFile('img')) {
            $img_path = $request->file('img')->store('', 'public');
            $post->img = $img_path;
        }

        $post->save();
        return redirect('/user/posts');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect('/user/posts');
    }
}
