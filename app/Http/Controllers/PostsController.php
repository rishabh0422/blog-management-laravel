<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->category_id) {
            $categories = Category::all();

            $posts = Post::with('category')
                ->when($request->category_id, function ($query) use ($request) {
                    $query->where('category_id', $request->category_id);
                })
                ->paginate(5);
            return view('posts.index', compact('posts', 'categories'));
        }
        $categories = Category::all();
        $posts = Post::paginate(5);
        return view('posts.index', compact('posts', 'categories'));
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
            'body' => 'required|string|min:10',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
         $img_path = $request->file('img')->store('', 'public');
        $post = new Post();
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->body = $request->body;
        $post->category_id = $request->category_id;
        $post->user_id = auth()->id();
        $post->img =$img_path;
        $post->save();
        return redirect('/posts');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {   
        $post=Post::with(['category','user'])->where('slug',$slug)->firstOrFail();
        return view('posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        $categories = Category::all();
        $post = DB::table('posts')
            ->join('categories', 'posts.category_id', '=', 'categories.id')
            ->select(
                'posts.id',
                'posts.title',
                'posts.body',
                'posts.img',
                'categories.id as category_id',
                'categories.name as category_name',
            )->where('posts.id', $id)->first();
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
            'body' => 'required|string|min:10',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
         $img_path = $request->file('img')->store('', 'public');
        $post = Post::findOrFail($id);
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->body = $request->body;
        $post->category_id = $request->category_id;
        $post->user_id = auth()->id();
        $post->img = $img_path;
        $post->save();
        return redirect('/posts');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect('/posts');
    }
}
