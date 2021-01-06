<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::all();
        return view('post.posts')->with('posts',$posts);
    }

    public function form($_id = false){
        if($_id){
            $post = Post::findOrFail($_id);
        }else{
            $post = false;
        }
        return view('post.form',compact('post'));    }

    public function save(Request $request){
        $post = new Post($request->all());
        if($request->hasFile('image')){
            $post->image = $request->image->store('uploads', 'public');
        }
        $post->created_by = \Auth::user()->_id;
        $post->save();
        if($post){
            return redirect()->route('home');
        }
        else{return back();}
    }

    public function update(Request $request, $_id){
        $post = Post::findOrFail($_id);
        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();
        if($post){
            return redirect()->route('home');
        }
        else{return back();}
    }

    public function delete($_id){
        $post = Post::destroy($_id);
        if($post){
            return redirect()->route('home');
        }
        else{dd("Error! Cannot delete this post");}
    }
    public function like($_id){
        $post = Post::where('_id', $_id)->first();
        $post->likes = array(\Auth::user()->_id);
        $post->save();
        return redirect()->route('home');
    }
}
