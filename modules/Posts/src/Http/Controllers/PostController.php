<?php

namespace Modules\Posts\src\Http\Controllers;

use Modules\Posts\src\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Modules\Posts\src\Http\Requests\PostRequest;

class PostController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:post-list|post-create|post-edit|post-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:post-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:post-edit', ['only' => ['edit', 'update']]);
    }

    public function index()
    {
        $posts = Post::paginate(5);

        return view('Posts::index', compact('posts'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('Posts::create');
    }

    public function store(PostRequest $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();
        $post = new Post([
            'title' => $request->title,
            'content' => $request->content,
            'published_at' => $request->published_at,
            'status' => $request->status,
        ]);
        $post->author = $user->id;

        $path = 'storage/uploads/';
        if ($request->hasfile('images')) {
            $file = $request->file('images');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extenstion;
            $file->move($path, $filename);
        }
        $post->images = $path . $filename;
        $post->save();
        return redirect()->route('posts.index')
            ->with('success', 'Post created successfully.');
    }

    public function show($id)
    {
        $post = Post::find($id);
        return view('Posts::show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('Posts::edit', compact('post'));
    }

    public function update(PostRequest $request, $id)
    {
        $request->validate(
            [
                'title' => 'required',
                'content' => 'required',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
            ]
        );

        $post = Post::findOrFail($id);
     
        $post->title = $request->title;
        $post->content = $request->content;
        $post->status = $request->status;          

        if ($request->has('images')) {
            $file = $request->file('images');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'storage/uploads/';
            $file->move($path, $filename);
            if (File::exists($post->images)) {
                File::delete($post->images);
            }
        }
        $post->images = $path . $filename;

        $post->save();
        return redirect()->route('posts.index')
            ->with('success', 'Post updated successfully');
    }

    public function destroy($id)
    {
        Post::destroy($id);
        return redirect()->route('posts.index')
            ->with('success', 'Post deleted successfully');
    }
}
