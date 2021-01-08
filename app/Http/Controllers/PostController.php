<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;

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
        if(in_array(\Auth::user()->_id, $post->likes)){
            $post->pull("likes", \Auth::user()->_id);
            $post->save();
            return response()->json([
                'likes' => sizeof($post->likes)
            ]);

        }else
            $post->push("likes", \Auth::user()->_id);
        $post->save();
        return response()->json([
            'likes' => sizeof($post->likes)
        ]);
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
            function unique_code($limit)
            {
            return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
            }
            $id = unique_code(9);
            $comment['_id'] = $id;
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

    public function deleteComment($_id,$_cid){
        if($_id){
            $post = Post::findOrFail($_id);
            if($_cid){
                // for($i=0;$i<sizeof($post->comments);$i++){
                //     if($post->comments[$i]['_id']==$_cid){
                //         $comments = $post->comments;
                //         unset($comments[$i]);
                //         $post->unset('comments');
                //         $post->comments = $comments;
                //         $post->save();
                //         break;
                //     }
                // }
                    $key = array_search($_cid,$post->comments);
                    $post->pull('comments',$post->comments[$key]);
                    $post->save();
                return \redirect()->route("comment", $post->_id);
            }
            return \redirect()->route("comment", $post->_id);
        }
        return \redirect()->route("comment", $post->_id);

    }

    public function editComment($_id,$_cid){
            $post = Post::findOrFail($_id);
            // $key = array_search($_cid,$post->comments);
            for($i=0;$i<sizeof($post->comments);$i++){
                if($post->comments[$i]['_id']==$_cid){
                    $c = $post->comments[$i];
                    break;
                }
            }
            // $c = $post->comments[$key];
            return view('post.comments')
                    ->with(compact('post'))
                    ->with('c',$c);
    }
    public function editContentComment(Request $request,$_id,$_cid){
            $post = Post::findOrFail($_id);
            // $key = array_search($_cid,$post->comments);
            for($i=0;$i<sizeof($post->comments);$i++){
                if($post->comments[$i]['_id']==$_cid){
                    $comment = $post->comments[$i];
                    break;
                }
            }
            $post->pull('comments',$comment);
            $post->save();
            $comment['content'] = $request->content;
            $post->push('comments',$comment);
            $post->save();
            return \redirect()->route("comment", $post->_id);
    }
}
