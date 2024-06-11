<?php

namespace Modules\Posts\src\Http\Controllers;

use Modules\Posts\src\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Modules\Posts\src\Http\Requests\PostRequest;

class PostController extends Controller
{
    // function __construct()
    // {
    //     $this->middleware('permission:post-list|post-create|post-edit|post-delete', ['only' => ['index', 'store']]);
    //     $this->middleware('permission:post-create', ['only' => ['create', 'store']]);
    //     $this->middleware('permission:post-edit', ['only' => ['edit', 'update']]);
    // }

    public function index()
    {
        $posts = Post::paginate(5);

        return response()->json([
            'status' => 'Success',
            'data' => $posts,
        ], 200);
    }
    public function show($id)
    {
        $post = Post::find($id);
        return response()->json([
            'status' => 'Success',
            'data' => $post,
        ], 200);
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
        // $post->author = $user->id;

        $path = 'storage/uploads/';
        if ($request->hasfile('images')) {
            $file = $request->file('images');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extenstion;
            $file->move($path, $filename);
            $post->images = $path . $filename;
        }
        $post->save();
        if ($post) {
            return response()->json(['status' => 'Create Post Success', 'post' => $post]);
        }
        return response()->json(['status' => 'Create Post Failure']);
    }

    public function update(PostRequest $request, $id)
    {
        // $request->validate(
        //     [
        //         'title' => 'required',
        //         'content' => 'required',
        //         'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        //     ]
        // );

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
        if ($post) {
            return response()->json([
                'status' => 'Post User Success',
                'data' => $post,
            ], 200);
        }
        return response()->json(['status' => 'Update Post Failure']);
    }

    public function destroy($id)
    {
        $result = Post::destroy($id);
        if ($result) {
            return response()->json([
                'status' => 'Delete Post Success',
            ], 200);
        }
        return response()->json(['status' => 'User Not Found']);
    }
}
