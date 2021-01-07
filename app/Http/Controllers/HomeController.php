<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;


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
        if(isset($_GET['filter']) && $_GET['filter'] != ""){
            $posts = Post::where("title", "like", $_GET['filter'])
                            ->orWhere("content", "like", "%".$_GET['filter']."%")
                            ->orWhere("created_by.name", "like", "%".$_GET['filter']."%")
                            ->orderByDesc('created_at')
                            ->get();
        }else{
            $posts = Post::orderByDesc("created_at")->get();
        }
        return view('home')->with('posts',$posts);
    }
}
