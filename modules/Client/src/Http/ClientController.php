<?php
namespace Modules\Client\src\Http;

use Modules\Posts\src\Models\Post;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    public function index()
    {
        $posts = Post::where('status', 1)->get();
        return view('Client::index',compact('posts'));
    }
}