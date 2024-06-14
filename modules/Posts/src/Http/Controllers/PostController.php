<?php

namespace Modules\Posts\src\Http\Controllers;

use Modules\Like\src\Models\Like;
use Modules\Posts\src\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Modules\Posts\src\Http\Requests\PostRequest;

class PostController extends Controller
{
    function __construct()
    {   
        $this->middleware('role:Super Admin', ['only' => ['index', 'store', 'update', 'destroy']]);
        $this->middleware('role:Writer',['only'=>'create','update']);
    }

    public function index()
    {
        $posts = Post::withCount('likes')->paginate(10);

        return response()->json([
            'status' => 'Success',
            'data' => $posts,
        ], 200);
    }
    
    public function show($id)
    {
        $post = Post::withCount('likes')->find($id);
        return response()->json([
            'status' => 'Success',
            'data' => $post,
        ], 200);
    }

    public function store(PostRequest $request)
    {
        $data = $request->except('token');
        if (!empty($request->images)) {
            $data['images'] = 'uploads/' . $request['images'];
        }

        $post = Post::create($data);
        if ($post) {
            $path = storage_path('app/public/uploads');
            if (!File::exists($path)) {
                File::makeDirectory($path, $mode = 0777, true, true);
            }
            if (!empty($request->images)) {
                $tempPath = 'tmp/' . $request->images;
                $newPath = 'uploads/' . $request->images;
                if (File::exists(storage_path("app/public/$tempPath"))) {
                    File::move(storage_path("app/public/$tempPath"), storage_path("app/public/$newPath"));
                }
            }
            return response()->json(['status' => 'SUCCESS', 'post' => $post], 200);
        }
        return response()->json(['status' => 'RESOURCE_NOT_FOUND'], 200);
    }

    public function update(PostRequest $request, $id)
    {
        $data = $request->except('token');
        $post = Post::find($id);
        $oldImages = $post->images;
        if (!empty($request->images)) {
            $data['images'] = 'uploads/' . $request['images'];
        }
        if (!$post) {
            return response()->json(['status' => 'RESOURCE_NOT_FOUND'], 200);
        }
        $result = $post->update($data);
        if ($result) {
            $path = storage_path('app/public/uploads');

            if (!File::exists($path)) {
                File::makeDirectory($path, $mode = 0777, true, true);
            }

            $newImages = "";
            if (!empty($request->images)) {
                $tempPath = 'tmp/' . $request->images;
                $newImages = 'uploads/' . $request->images;
                if (File::exists(storage_path("app/public/$tempPath"))) {
                    File::move(storage_path("app/public/$tempPath"), storage_path("app/public/$newImages"));
                }
            }

            if (!empty($oldImages) && $oldImages != $newImages) {
                if (File::exists(storage_path("app/public/$oldImages"))) {
                    File::delete(storage_path("app/public/$oldImages"));
                }
            }
            return response()->json(['status' => 'SUCCESS', 'post' => $post]);
        }
        return response()->json(['status' => 'RESOURCE_NOT_FOUND'], 200);
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

    public function like($id)
    {
        $user = auth()->user();
        $post = Post::findOrFail($id);
        $like = new Like([
            'user_id' => $user->id,
            'post_id' => $post->id,
        ]);
        $like->save();

        return response()->json([
            'status' => 'Like Post Success',
            'data' => $like,
        ], 200);
    }


    public function unlike($id)
    {
        $user = Auth::user();
        $like = Like::where('post_id', $id)->where('user_id', $user->id)->first();
        if ($like) {
            $like->delete();
            return response()->json([
                'status' => 'Unlike Post Success',
            ], 200);
        }

        return response()->json([
            'status' => 'Like Not Found',
        ], 404);
    }
}
