<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use Carbon\Carbon;

class PostController extends Controller
{

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
        $post->created_by = ["id" => \Auth::user()->_id, "name" => \Auth::user()->name];
        $post->likes = array();
        $post->comments = array();
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
        $post = Post::findOrFail($_id);
        if(in_array(\Auth::user()->_id, $post->likes))
            $post->pull("likes", \Auth::user()->_id);
        else
            $post->push("likes", \Auth::user()->_id);
        $post->save();
        return redirect()->route($_GET['route']);

    }

    public function getComments($_id){

        if($_id){

            $post = Post::findOrFail($_id);

        }else{
            $post = false;
        }
        return view('post.comments')
                ->with(compact('post'));
    }

    public function createComment(Request $request, $_id){
        if($_id){
            $post = Post::findOrFail($_id);
            $comment = array();
            $user = \Auth::user();
            $comment['content'] = $request->content;
            $comment['user'] = array(
                '_id' => $user->_id,
                'name' => $user->name,
                'image' => $user->image
            );
            $comment['created_at'] = ''.Carbon::now();
            $post->push('comments',$comment);
            $post->save();
            return \redirect()->route("comment", $post->_id);

        }else{
            $post = false;
            return \redirect()->route("comment", $post->_id);
        }

    }
}
